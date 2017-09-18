@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">The beautiful Laravel</p>
        </div>
    </div>

        @foreach($posts as $key => $post)
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="post-title">{{ $post['title'] }}</h1>
                    <p>{{ $post['content'] }}</p>
                    <p><a href="{{ route('blog.post', ['id' => ($key+1)]) }}">Read more...</a></p>
                </div>
            </div>
            @if($key < count($posts) - 1)
                <hr>
            @endif
        @endforeach

@endsection