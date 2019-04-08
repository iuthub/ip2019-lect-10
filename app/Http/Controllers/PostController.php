<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function getIndex()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {
        
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $post = Post::find($id); //->with('likes') eager loads records
        return view('blog.post', ['post' => $post]);
    }


    public function getLikePost($id) {
        $post = Post::find($id);
        $post->likes()->save(new Like());
        return redirect()->back();
    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags'=>$tags]);
    }

    public function getAdminEdit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags'=>$tags]);
    }

    public function getAdminDelete($id)
    {
        $post = Post::find($id);

        //don't forget to delete related records
        $post->likes()->delete();
        $post->delete();
        $post->tags()->detach();

        return redirect()->route('admin.index')->with('info', 'Post deleted. ');
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post([
            'title'=>$request->input('title'),
            'content'=>$request->input('content')
        ]);


        $post->save();
        $post->tags()->attach($request->input('tags')?$request->input('tags'):[]);

        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post=Post::find($request->input('id'));
        $post->update([
            'title'=>$request->input('title'),
            'content'=>$request->input('content')
        ]);

        // $post->tags()->detach(); //remove all relationships first
        // $post->tags()->attach($request->input('tags')?$request->input('tags'):[]);

        $post->tags()->sync($request->input('tags')?$request->input('tags'):[]);
        
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

}
