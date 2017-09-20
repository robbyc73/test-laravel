<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Like;

/**
 * Class LikeController
 * @package App\Http\Controllers
 */
class LikeController extends Controller
{
    public function getLikeCreate(Request $request, $postId)
    {
        $post = Post::find($postId);

        if(!$post instanceof Post){
            throw new \Exception("post not found!");
        }

        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }
}
