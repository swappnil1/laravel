<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\input;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::all();
        return view('post.index',compact('post'));
    }


    public function create()
    {

    }


    public function addPost(Request $request)
    {
        $rules  = array(
            'title' => 'required',
            'body' => 'required'
        );
        $validator = Validator::make ( input::all(),$rules );
        if($validator->fails())
            return response::json(array('error'=>$validator->getMessageBag()->toarray()));
        else{
            $post = new Post;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            return response()->json($post);
        }
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));

    }


    public function editPost(Request $request)
    {
        $post = Post::find  ($request->id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return response()->json($post);
    }


    public function deletePost(request $request){
        $post = Post::find ($request->id)->delete();
        return response()->json();
    }


    public function destroy($id)
    {
        //
    }
}
