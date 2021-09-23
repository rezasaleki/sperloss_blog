<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'activated' => ['required'],
            'image' => ['required', 'image'],
            'user_id' => [],
            'thumbnail' => ['image']
        ]);

        if (request('image')) {
            $imagePath1 = request('image')->store('uploads', 'public'); // upload image to storage directory and create symbolic link to public directory
            Image::make(public_path("storage/{$imagePath1}"))->save(); // fit image to custome size by package intervention
        }

        if (request('thumbnail')) {
            $imagePath2 = request('thumbnail')->store('uploads', 'public'); // upload image to storage directory and create symbolic link to public directory
            Image::make(public_path("storage/{$imagePath2}"))->fit(100, 100)->save();
        }

        $data['user_id'] = auth()->user()->id;
        $data['visited'] = 0;
        $data['visit'] = 0;

        auth()->user()->posts()->create(array_merge(
            $data,
            [
                'image' => $imagePath1 ?? null,
                'thumbnail' => $imagePath2 ?? null
            ]
        )); // save post by relationship

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        return redirect("profiles/" . $profile->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
