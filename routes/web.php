<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $blogs = App\Blog::where("published", 1)->orderBy('published_at', 'desc')->get();
    foreach($blogs as $index => $blog){
        $quill = new QuillRender($blog->content);
        $blogs[$index]->content = $quill->render();
    }

    return view('welcome', [
        'blogs' => $blogs
    ]);
});
