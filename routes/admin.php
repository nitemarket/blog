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

Route::get('/', function(){
    return redirect()->route('blogs.index');
})->name('admin');

Auth::routes();

Route::post('blogs/upload', 'Admin\BlogController@upload')->name('upload');
Route::post('blogs/publish', 'Admin\BlogController@publish')->name('publish');
Route::resource('blogs', 'Admin\BlogController', ['except' => [
    'show'
]]);
