<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Route;
use Auth;
use Storage;
use Carbon;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Auth::user()->blogs()->orderBy('updated_at', 'desc')->get();

        return view('Admin.home', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.create_blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = Auth::user()->blogs()->updateOrCreate(
            ['_id' => $request->input('id')],
            ['title' => $request->input('title'), 'content' => $request->input('content')]
        );

        return response()->json([
            'id' => $blog->_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('Admin.create_blog', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('Admin.create_blog', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $path = $file->store('public');
            }
        }

        if(isset($path) && $path){
            $json = [
                'status' => 200,
                'success' => 1,
                'data' => [
                    'link' => asset("storage/" . basename($path)),
                ]
            ];
        }
        else {
            $json = [
                'status' => 400,
                'success' => 0,
            ];
        }
        return response()->json($json);
    }

    public function publish(Request $request)
    {
        $blog = Blog::find($request->input('id'));
        $toPublish = $request->input('published');
        $blog->published = (int) $toPublish;
        $blog->published_at = $toPublish ? Carbon::now() : "";
        $blog->save();

        return response()->json([
            'published' => (int) $toPublish,
        ]);
    }

    public function mass_upload()
    {
        return view('Admin.mass_upload');
    }
}
