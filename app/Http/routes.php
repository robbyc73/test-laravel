<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('post/{id}', function ($id) {
    if ($id == 1) {
        $post = [
            'title' => 'Learning Laravel',
            'content' => 'This blog post will get you right on track with Laravel!'
        ];
    } else {
        $post = [
            'title' => 'Something else',
            'content' => 'Some other content'
        ];
    }
    return view('blog.post', ['post' => $post]);
})->name('blog.post');

Route::get('about', function () {
    return view('other.about');
})->name('other.about');

Route::group(['prefix' => 'admin'], function() {
    Route::get('', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    Route::post('create', function(Request $request, Factory $validator) {
        /** @var Validator $validation */
        $validation = $validator->make($request->all(),['title' => 'required|unique:posts|max:255']);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post created, new Title: ' . $request->input('title'));
    })->name('admin.create');


    Route::get('edit/{id}', function ($id) {
        if ($id == 1) {
            $post = [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel!'
            ];
        } else {
            $post = [
                'title' => 'Something else',
                'content' => 'Some other content'
            ];
        }
        return view('admin.edit', ['post' => $post]);
    })->name('admin.edit');

    Route::post('edit', function(Request $request, Factory $validator) {

        /** @var Validator $validation */
        $validation = $validator->make($request->all(),['title' => 'required|min:2']);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post edited, new Title: ' . $request->input('title'));
    })->name('admin.update');
});

