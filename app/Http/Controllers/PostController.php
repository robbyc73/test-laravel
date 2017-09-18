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
    public function getIndex(Store $session)
    {
        $post = new Post();
        $posts = $post->getPosts($session);

        return view('blog.index',['posts' => $posts]);
    }
}
