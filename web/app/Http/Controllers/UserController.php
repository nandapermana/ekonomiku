<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\User;
use App\Image;
use Auth;
use Session;


class UserController extends Controller
{
    public function getLoginPage(){
        return view('welcome');
    }

    public function getDasboardPage(){
        $imageProfile = Image::where('user_id',Auth::user()->id)->first();
        $userData     = User::find(Auth::user()->id);
        $modul        = 'profile';
        return view('user.dashboard')->with(['photo'    => $imageProfile->name,
                                              'user'    => $userData,  
                                              'modul'   => $modul]);
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email'     => 'email|required',
            'password'  => 'required|min:4'
        ]);

        if( (Auth::attempt(['email'=> $request->input('email'),'password'=>$request->input('password')])) && (Auth::user()->type=='user')   )
        {
            if (Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
        return redirect()->route('dashboard.landing'); //bila login sukses ke halaman profile user
        }
        else
        {
            return redirect()->route('guest.login'); //kalo gagal refresh ulang 
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('guest.login');
    }

    public function postImageProfile(Request $request){
        //checked before upload 
        $this->validate($request,[
            'photo' => 'mimes:jpeg|dimensions:max_width=2500,max_height=2500'
        ]);
        $currentImg = Image::where('user_id',Auth::user()->id)->first();
        if ($currentImg) {
            $img = $currentImg;
        }
        else{
            $img= new File;
        }
        $img->title = 'poto_profile.jpg';
        if (Input::hasFile('photo')) {
            $file = Input::file('photo');
            $file->move(public_path().'/',$img->title);
            $img->name      = 'poto_profile.jpg';
            $img->size      = $file->getClientsize();
            $img->type      = $file->getClientMimeType();
            $img->user_id   = Auth::user()->id;
        }
        $img->save();
        return redirect()->route('dashboard.landing');
    }

    public function postUpdateProfile(Request $request){
        $this->validate($request, [
            'name'                 =>'required| max:18',
            'email'                =>'email|required|exists:users',
            'description'          =>'required|min:1',
        ]);

        Auth::user()->name           = $request->input('name');
        Auth::user()->email          = $request->input('email');
        Auth::user()->description    = $request->input('description');
        Auth::user()->save();
        $message = "Profile updated";
        return redirect()->route('dashboard.landing')->with(['success_message'=> $message]);
    }

    public function postUpdatePassword(Request $request){
        $this->validate($request, [
            'oldPassword'          =>'required|min:4',
            'newPassword'          =>'required|min:4',
        ]);

        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            Auth::user()->password       = Hash::make($request->newPassword);
            Auth::user()->save();
            $message = "Password updated";
            return redirect()->route('dashboard.landing')->with(['success_message'=> $message]);
        }
        else{
            $message= 'Wrong Old Password!! , Password can not updated';
            return redirect()->route('dashboard.landing')->with(['error_message'=> $message]);
        }
    }

    public function getImageUpload(){  
        return view('dashboard.image');
    }

}
