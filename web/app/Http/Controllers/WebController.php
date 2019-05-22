<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Post;
use App\Comment;
use App\Image;
use App\pdf;
use DB;
use App\BlogComment;
use App\Repositories\Repository;
use App\Ads;

class WebController extends Controller
{
    protected $postModel;
    protected $userModel;

    public function __construct(Post $post, User $user)
   {
       // set the model
       $this->postModel = new Repository($post);
       $this->userModel = new Repository($user);
   }

    public function getIndex(){
        $modul = 'index';
        $post  = $this->getOffset('post',0,2);
        $sixpost = $this->getOffset('post',0,6);
        $whereClause = ['value'  => 'id',
                        'clause' => '!=',
                        'value2' =>  1   ];
        $file  = $this->getOffset('files',0,6, $whereClause);
        $pdf   = $this->getOffset('pdf',0,2);
        $ads   = Ads::all();

    	return view('public.index')->with([ 'post'   => $post,
                                            'img'    => $file,
                                            'pdf'    => $pdf,
                                            'modul'  => $modul,
                                            'sixpost'=> $sixpost,
                                            'ads'    => $ads,
                                         ]);
    }

    public function getAbout(){
        $user = $this->userModel->getCertainUser(1);
        $modul = 'about';
    	return view('public.about')->with(['user' => $user, 'modul' => $modul]);
    }

    public function countPost(){
        return $this->postModel->countData();
    }

    public function getOffset($table,$skip,$limit,$whereClause=null){
        if ($whereClause) {
            $item  = collect(DB::table($table)
                    ->skip($skip)
                    ->take($limit)
                    ->where($whereClause['value'],
                            $whereClause['clause'],
                            $whereClause['value2'])
                    ->orderBy($table .'.updated_at','DESC')
                    ->get());
        }
        else{
            $item  = collect(DB::table($table)
                    ->skip($skip)
                    ->take($limit)
                    ->orderBy($table .'.updated_at','DESC')
                    ->get());
        }
        return $item;
    }

    public function getBlog($page){
        $modul = 'blog';
        $page         = (int)$page;
        $limit        = 6;
        $offset       = ($limit * ($page-1));
    	$post         = $this->getOffset('post',$offset,$limit);
        $count        = $this->countPost();
        $totalPage    = (int)ceil($count/$limit);
        $pageControl  = [ 'nextPage' =>null,
                          'prevPage' =>null];
        if ((($page==1) && ($totalPage !==1)) || $page < $totalPage ) {
            $pageControl['nextPage']=1;
        }
        if (($page<=$totalPage) && ($page!==1)){
            $pageControl['prevPage']=1;
        }
    	return view('public.blog')->with(['post'        => $post,
                                          'count'       => $count,
                                          'totalPage'   => $totalPage,
                                          'pageControl' => $pageControl,
                                          'page'        => $page,
                                          'modul'       => $modul,
                                          ]);
    }

    public function postComment(Request $request){
        $this->validate($request,[
            'name'     =>  'required',
            'email'    =>  'email|required',
            'message'  =>  'required|max:1000',
            'mobile'   =>  'required|min:11|numeric',
        ]);

        $comment = new Comment;
        $comment->name    = $request->input('name');
        $comment->email   = $request->input('email');
        $comment->message = $request->input('message');
        $comment->mobile  = $request->input('mobile');
        $comment->save();
        return redirect()->back();
    }

    public function getReadBlog($id)
    {
        $post = Post::find($id);
        $comment = BlogComment::where('blog_id',$id)->get();
        $modul = 'blog';
        $user  = User::find($post->user_id);
        return view('public.blogsingle')->with(['modul' => $modul,
                                                'post'  => $post,
                                                'author'=> $user->name,
                                                'comment'=> $comment]);
    }

    public function postBlogComment( Request $request , $blogId){
        $this->validate($request,[
            'nama'      => 'required',
            'email'     => 'email|required',
            'message'   => 'required',
        ]);
        
        $comment = new BlogComment;
        $comment->name  = $request->input('nama');
        $comment->email = $request->input('email');
        $comment->message = $request->input('message');
        if ($request->input('website')!==null) {
            $comment->website = $request->input('website');
        }
        $comment->blog_id = $blogId;
        $comment->save();
        return redirect()->back();
    }

    public function getPhotoPage(){
        $modul = 'photo';
        $photo = Image::where('id', '!=', 1)->get();
        return view('public.photo')->with(['modul'=> $modul,
                                           'photo'=> $photo]);

    }

    public function countPdf()
    {
        $pdf = pdf::all();
        return count($pdf);
    }
    public function getPdfPage($page){
        $modul        = 'pdf';
        $page         = (int)$page;
        $limit        = 6;
        $offset       = ($limit * ($page-1));
        $pdf          = $this->getOffset('pdf',$offset,$limit);
        $count        = $this->countPdf();
        $totalPage    = (int)ceil($count/$limit);
        $pageControl  = [ 'nextPage' =>null,
                          'prevPage' =>null];
        if ((($page==1) && ($totalPage !==1)) || $page < $totalPage ) {
            $pageControl['nextPage']=1;
        }
        if (($page<=$totalPage) && ($page!==1)){
            $pageControl['prevPage']=1;
        }
        return view('public.pdf')->with([ 'pdf'        => $pdf,
                                          'count'       => $count,
                                          'totalPage'   => $totalPage,
                                          'pageControl' => $pageControl,
                                          'page'        => $page,
                                          'modul'       => $modul,
                                          ]);
    }
    
}