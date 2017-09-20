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
        $posts = Post::orderBy('title', 'asc')->paginate(2);
        return view('blog.index',['posts' => $posts]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdminIndex()
    {
        $posts = Post::orderBy('title', 'asc')->paginate(2);
        return view('admin.index', ['posts' => $posts]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost($id)
    {
        $tags = Tag::all();
        $post = Post::where('id',$id)->with('likes')->with('tags')->first();

        $postTags = $post->tags;
        $postTagIds = [];
        foreach($postTags as $postTag){
            $postTagIds[] = $postTag->id;
        }

        $freeTags = $tags->except(implode(',',$postTagIds));

        return view('blog.post', ['post' => $post, 'freeTags' => $freeTags]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdminEdit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        /** @var Post $post */
        $post = Post::find($request->input('id'));
        $post->fill([
            'title' => $request->input('title'),
            'content' =>  $request->input('content')
        ]);

        $post->save();
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAdminDelete($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        $title = $post->title;
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info', 'Post '.$title.' deleted');
    }
}
