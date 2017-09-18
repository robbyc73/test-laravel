@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" value="{{ $post['title'] }}" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" value="{{ $post['content'] }}" class="form-control" id="content" name="content">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="id" value="{{ $postId }}">
            </form>
        </div>
    </div>
@endsection