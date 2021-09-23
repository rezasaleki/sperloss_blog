<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::findOrFail($username);
        // $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function () use ($user) {
        //     return $user->posts->count();
        // });

        // return view('profiles.index', compact('user', 'postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $this->authorize('view', $profile);

        $user = User::findOrFail($profile->user_id);
        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $profile = $profile->load('user.posts');
        return view('profiles.show', compact('profile', 'postCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profile $profile)
    {
        $this->authorize('update', $profile);

        $data = request()->validate([
            'title' => 'required',
            'bio' => 'required',
            'website' => ['required', 'url'],
            'image' => ['required', 'image']
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public'); // upload image to storage directory and create symbolic link to public directory
            Image::make(public_path("storage/{$imagePath}"))->fit(500, 500)->save(); // fit image to custome size by package intervention
        }

        auth()->user()->profile()->update(array_merge(
            $data,
            [
                'image' => $imagePath ?? null,
            ]
        )); // save post by relationship

        return redirect("profiles/" . $profile->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        //
    }
}
