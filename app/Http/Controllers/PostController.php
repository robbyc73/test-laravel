<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use Illuminate\Session\Store;


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

    public function getPost(Store $session, $id)
    {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $post]);
    }

    public function getAdminCreate()
    {
        return view('admin.create');
    }

    public function getAdminEdit(Store $session, $id)
    {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    public function postAdminCreate(Store $session, Request $request)
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

    public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post();
        $post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
}
