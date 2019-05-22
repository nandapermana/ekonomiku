<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Post;
use App\Comment;
use Auth;
use DB;
use Session;
use App\Image;
use File;
use App\pdf;
use Carbon\Carbon;
use App\Ads;
use App\HeaderImage;
class PostController extends Controller
{
    public function getManagePost(){
        $post = Post::all();
        $modul = 'manage';
        return view('user.manage_post')->with(['post'=> $post,
                                               'modul' => $modul]);
    }

    public function getDeletePost( Request $request){
        $header = HeaderImage::where('post_id', $request['id'])->first();
        $url = public_path().'/'.$header->name;
        File::delete($url);
        $header->delete();

        $post = Post::find($request['id']);
        $post->delete();
        return response()->json([
            'data' => $request['id']
        ]);
    }

    public function getWritePost(){
        $modul = 'write';
        return view('user.write_post')->with(['modul'=>$modul]);
    }

    public function postWritePost(Request $request){
        $this->validate($request, [
            'title'                =>'required',
            'description'          =>'required',
            'header_image'         =>'required|mimes:jpeg,png|dimensions:max_width=2500,max_height=2500',
        ]);

        $post               = new Post;
        $post->title        = $request->input('title');
        $post->body         = $request->input('description');
        $post->user_id      = Auth::user()->id;
        $post->image_url    = null;
        $post->save();

        if (Input::hasFile('header_image')) {
            $header             = new HeaderImage;
            $header->post_id    = $post->id;
            $file               = Input::file('header_image');
            $now                = Carbon::now()->format('M_d_Y_H_i_s');
            $header->name       = ($file->getClientMimeType() === "image/jpeg") ? 'header_'.$now.'.jpg' : 'header_'.$now.'.png' ;
            $header->size       = $file->getClientsize();
            $header->type       = $file->getClientMimeType();
            $file->move(public_path().'/',$header->name);
            $header->save();
        }

        $message = "Success! ";
        return redirect()->back()->with(['success_message'=> $message]);
    }

    public function postEditPost($id,Request $request){
        $this->validate($request,[
            'title'         => 'required',
            'description'   => 'required',
            'header_image'  => 'mimes:jpeg,png|dimensions:max_width=2500,max_height=2500',
        ]);

        $post = Post::find($id);        
        $post->user_id      = Auth::user()->id;
        $post->title        = $request->input('title');
        $post->body         = $request->input('description');
        $post->image_url    = $request->input('image-link');
        $post->save();

        if (Input::hasFile('header_image')) {
            $header             = HeaderImage::where('post_id',$id)->first();

            //delete old image
            
            $url = public_path().'/'.$header->name;
            File::delete($url);

            $file               = Input::file('header_image');
            $now                = Carbon::now()->format('M_d_Y_H_i_s');
            $header->name       = ($file->getClientMimeType() === "image/jpeg") ? 'header_'.$now.'.jpg' : 'header_'.$now.'.png' ;
            $header->size       = $file->getClientsize();
            $header->type       = $file->getClientMimeType();
            $file->move(public_path().'/',$header->name);
            $header->save();
        }

        $message = "Post is updated";
        return redirect()->route('dashboard.managePost')->with(['success_message' => $message]);
    }

    public function getEditPost($id){
        $post  = Post::find($id);
        $modul = "manage";
        $header_image = HeaderImage::where('post_id', $id)->first();
        return view('user.edit_post')->with(['post'=>$post , 'modul' => $modul , 'header' => $header_image]);
    }

    public function getJsonPost(){
        $post = Post::all();
        return response()->json(['data'=>$post]);
    }

    public function getPreviewPost($id){
        $post = Post::find($id);
        $header = HeaderImage::where('post_id',$id)->first();
        $modul = "manage";
        return view('user.peview_post')->with(['post'=> $post, 'modul' => $modul, 'header' => $header]);
    }

    public function getImage(){
        $modul = "image";
        $file = Image::all();
        return view('user.image')->with(['image'=>$file, 'modul'=> $modul]);
    }

    public function getUploadImage(){
        $modul = "image";
        return view('user.upload_image')->with(['modul' => $modul]);
    }

    public function postUploadImage(Request $request){
        $this->validate($request,[
            'image' => 'mimes:jpeg,png|dimensions:max_width=2500,max_height=2500'
        ]);

        
        if (Input::hasFile('image')) {
            $img            = new Image;
            $file = Input::file('image');
            $now            = Carbon::now()->format('M_d_Y_H_i_s');
            $img->title     = ($file->getClientMimeType() === "image/jpeg") ? 'image_'.$now.'.jpg' : 'image_'.$now.'.png' ;
            $img->name      = ($file->getClientMimeType() === "image/jpeg") ? 'image_'.$now.'.jpg' : 'image_'.$now.'.png' ;
            $img->size      = $file->getClientsize();
            $img->type      = $file->getClientMimeType();
            $img->user_id   = Auth::user()->id;
            $file->move(public_path().'/',$img->title);
        }
        $img->save();
        $message = "Photo Sucessfully upload";
        return redirect()->route('dashboard.image')->with(['success_message'=> $message]);
    }

    public function getDeleteImg( Request $request){
        $img = Image::find($request['id']);
        $url = public_path().'/'.$img->title;
        if(File::exists($url)) File::delete($url);
        $img->delete();
        return response()->json([
            'data' => $request['id']
        ]);
    }

    public function getComment($page){
        $modul          = 'comment';
        $page           = (int)$page;
        $limit          = 10;
        $offset         = ($limit * ($page-1));
        $comment        = $this->getOffset('comment',$offset,$limit);
        $count          = $this->countComment();
        $totalPage      = (int)ceil($count/$limit);
        $pageControl    = [ 'nextPage' =>null,
                            'prevPage' =>null];

        if ((($page==1) && ($totalPage !==1)) || $page < $totalPage ) {
            $pageControl['nextPage']=1;
        }
        if (($page<=$totalPage) && ($page!==1)){
            $pageControl['prevPage']=1;
        }

        return view('user.comment')->with(['comment'      => $comment , 
                                            'modul'       => $modul,
                                            'count'       => $count,
                                            'totalPage'   => $totalPage,
                                            'pageControl' => $pageControl,
                                            'page'        => $page
                                        ]);

    }

    public function getOffset($table,$skip,$limit,$whereClause=null){
        if ($whereClause) {
            $item  = collect(DB::table($table)
                    ->skip($skip)
                    ->take($limit)
                    ->where($whereClause['value'],
                            $whereClause['clause'],
                            $whereClause['value2'])
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

    public function countComment(){
        $allComment = Comment::all();
        $count   = count($allComment);
        return $count;
    }

    public function getPdfUpload()
    {
        $modul = 'pdf';
        $pdf   = pdf::all(); 
        return view('user.upload_pdf')->with(['modul' => $modul, 'pdf'  => $pdf]);
    }

    public function uploadPDF(Request $req)
    {
       $this->validate($req,[
            'pdf'           => 'mimes:pdf',
            'title'         => 'required|max:255',
            'description'   => 'required|max:1000',
            'url'           => 'required'
        ]);

        $pdf            =  new pdf;
        $now            = Carbon::now()->format('M_d_Y_H_i_s');
        $pdf->name      = 'pdf_'. $now . '.pdf';
        if (Input::hasFile('pdf')) {
            $file = Input::file('pdf');
            $file->move(public_path().'/',$pdf->name);
            $pdf->size          = $file->getClientsize();
            $pdf->type          = $file->getClientMimeType();
            $pdf->title         = $req->input('title');
            $pdf->description   = $req->input('description');
            $pdf->user_id       = Auth::user()->id;
            $pdf->image_url     = $req->input('url');
        }
        $pdf->save();
        $message = "Pdf Sucessfully upload";
        return redirect()->route('dashboard.pdf')->with(['success_message'=> $message]);
    }

    public function deletePdf(Request $req)
    {
        $pdf = pdf::find($req['id']);
        $url = public_path().'/'.$pdf->name;
        if(File::exists($url)) File::delete($url);
        $pdf->delete();
        return response()->json ([
            'data' => 'suceess delete pdf',
        ]);
    }

    public function editPdf( Request $req){
        $this->validate($req,[
            'title'         => 'required|max:255',
            'description'   => 'required|max:1000',
            'url'           => 'required',
            'id'            => 'required',
        ]);

        $pdf = pdf::find($req->input('id'));
        $pdf->image_url     = $req->input('url');
        $pdf->description   = $req->input('description');
        $pdf->title         = $req->input('title');
        $pdf->save();

        return redirect()->back();
    }

    public function ads(){
        $modul = 'ads';
        $ads   = Ads::all();
        return view('user.manage_ads')->with(['modul' => $modul, 'ads' => $ads]);
    }

    public function uploadAds(Request $req){
         $this->validate($req,[
            'image'         => 'mimes:jpeg,png|dimensions:max_width=1280,max_height=640,min_width=1280,min_height=640',
            'name'          => 'required|max:255',
            'description'   => 'required|max:1000',
            'url'           => 'required'
        ]);

        $ads    =  new Ads;
        $now    = Carbon::now()->format('M_d_Y_H_i_s');
        if (Input::hasFile('image')) {
            $file = Input::file('image');

            $type = ($file->getClientMimeType() === 'images/jpeg') ? '.jpeg' : '.png' ;
            $ads->file_name     = 'ads_'. $now . $type;
            $ads->size          = $file->getClientsize();
            $ads->type          = $file->getClientMimeType();
            $ads->name          = $req->input('name');
            $ads->description   = $req->input('description');
            $ads->user_id       = Auth::user()->id;
            $ads->url           = $req->input('url');
            $file->move(public_path().'/',$ads->file_name);
        }
        $ads->save();
        $message = "Ads Sucessfully upload";
        return redirect()->route('dashboard.ads')->with(['success_message'=> $message]);
    }

    public function editAds(Request $req){
        $this->validate($req,[
            'name'          => 'required|max:255',
            'description'   => 'required|max:255',
            'url'           => 'required',
            'id'            => 'required',
        ]);

        $ads = Ads::find($req->input('id'));
        $ads->name          = $req->input('name');
        $ads->url           = $req->input('url');
        $ads->description   = $req->input('description');
        $ads->save();
        $message = "Ads Successfully updated";
        return redirect()->back()->with(['success_message' => $message]);
    }

    public function deleteAds(Request $req)
    {
        $ads = Ads::find($req['id']);
        $url = public_path().'/'.$ads->file_name;
        if(File::exists($url)) File::delete($url);
        $ads->delete();
        return response()->json ([
            'data' => 'suceess delete ads',
        ]);
    }

}