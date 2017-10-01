@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <p class="quote">{{ $post->title }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <p>Likes: {{ count($post->likes) }} |
                <a href="{{ route('blog.post.like', ['postId' => $post->id]) }}">Like</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <p>{{ $post->content }}</p>
        </div>
    </div>
@endsection