<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function save(Request $request) {
        
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
            ]);
        
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        $comment->save();
        
        return redirect()->route('image.detail',['id' => $image_id])
                         ->with([
                             'message' => "your comment was published successfully"
                         ]);
    }
    
    public function delete($id) {
        //get data user
        $user = \Auth::user();
        //get comment
        $comment = Comment::find($id);
        //check if user created the image or comment
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
            return redirect()->route('image.detail',['id' => $comment->image->id])
                         ->with([
                             'message' => "your comment was deteled successfully"
                         ]);
        }else{
            return redirect()->route('image.detail',['id' => $comment->image->id])
                         ->with([
                             'message' => "your comment was NOT deteled successfully"
                         ]);
        }
    }
}
