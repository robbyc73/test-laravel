<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\Post;
use App\Tag;
use App\Http\Requests;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{

    /**
     * @param Store $session
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $posts = Post::all();
        return view('blog.index',['posts' => $posts]);
    }

    public function getAdminIndex()
    {
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $post = Post::where('id', $id)->first();
        return view('blog.post', ['post' => $post]);
    }

    public function getAdminCreate()
    {
        return view('admin.create');
    }

    public function getAdminEdit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.edit', ['post' => $post]);
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post([
            'title' =>  $request->input('title'),
            'content' => $request->input('content')
        ]);
        $post->save();

        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        /** @var Post $post */
        $post = Post::where('id', $request->input('id'))->first();
        $post->fill([
            'title' => $request->input('title'),
            'content' =>  $request->input('content')
        ]);

        $post->save();
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
}
