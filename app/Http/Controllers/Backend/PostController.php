<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ativePosts = Post::where('status', 'publish')->get();
        $draftPosts = Post::where('status', 'draft')->get();
        $trashPosts = Post::onlyTrashed()->get();
        return view('backend.post.index', compact('ativePosts', 'draftPosts', 'trashPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = $request->file('photo');

        $request->validate([
            'title' => 'required|unique:posts,title',
            'body' => 'required|max:5000',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'category' => 'required|integer'


        ]);

        if ($photo) {
            $photo_name = uniqid() . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)->crop(800, 500)->save(public_path('storage/post/' . $photo_name));
        }

        $data = new Post();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->body = $request->body;
        $data->category_id = $request->category;
        $data->photo = $photo_name;
        $data->save();
        return back()->with('success', "Post Created Successfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get(['id', 'name']);
        return view('backend.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $photo = $request->file('photo');

        $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id,
            'body' => 'required|max:5000',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
            'category' => 'required|integer'


        ]);

        if ($photo) {

            $path = public_path('storage/post/' . $post->photo);
            if (file_exists($path)) {
                unlink($path);
            }


            $photo_name = uniqid() . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)->crop(800, 500)->save(public_path('storage/post/' . $photo_name));
        } else {
            $photo_name = $post->photo;
        }


        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->photo = $photo_name;
        $post->save();
        return back()->with('success', "Post Updated Successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->status = 'draft';
        $post->save();
        $post->delete();
        return back()->with('success', "Post Trashed Successfull!");
    }
    public function postStatus(Post $post)
    {
        if ($post->status == 'draft') {
            $post->status = 'publish';
            $post->save();
        } else {
            $post->status = 'draft';
            $post->save();
        }
        return back()->with('success', "Status Updated Successfull!");
    }
    public function postRestore($id){
        $post= Post::onlyTrashed()->find($id);
        $post->restore();
        return back()->with('success', "Post Restore Successfull!");
    }
    public function postForceDelete($id){
        $post = Post::onlyTrashed()->find($id);
        $post->forceDelete();
        return back()->with('success', "Post Restore Successfull!");
    }
}