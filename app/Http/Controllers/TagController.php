<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;

class TagController extends Controller
{
    public function getPostTag(Request $request, $postId, $tagId)
    {
        $post = Post::find($postId);

        $tag = Tag::find($tagId);

        if(!$post instanceof Post){
            throw new \Exception("Post not found!");
        }

        if(!$tag instanceof Tag){
            throw new \Exception("Tag not found!");
        }

        $post->tags()->attach($tagId);
        return redirect()->back();
    }
}
