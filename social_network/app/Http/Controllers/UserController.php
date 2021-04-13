<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function settings() {
        return view('user.settings');
    }
    
    public function update(Request $request) {
        //get user identify
        $user = \Auth::user();
        $id = $user->id;
        //validate form
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255,|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        //get data form
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        //fill new values
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        //upload image
        $image_path = $request->file('image_path');
        if($image_path){
            //rename with unique name
           $image_path_name = time().$image_path->getClientOriginalName();
           //save in storage/app/users
           Storage::disk('users')->put($image_path_name, File::get($image_path));
           //set the image to object
           $user->image = $image_path_name;
        }
        
        // meke consult
        $user->update();
        
        return redirect()->route('settings')->with(['message'=>'User updated successfully']);
    }
    
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile($id) {
        $user = User::find($id);
        
        return view('user.profile',[
            'user' => $user
        ]);
    }
}
