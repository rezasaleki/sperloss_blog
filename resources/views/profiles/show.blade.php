@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="rounded-circle" style="width:10rem" src="{{ $profile?->profileImage() }}" alt="freeCodeCamp">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $profile->user->username }}</h1>
                <h5>
                    @can('update', $profile)
                        <a style="text-decoration: none" href="{{ route('posts.create') }}">New Post</a>
                    @endcan
                    |
                    @can('update', $profile)
                        <a style="text-decoration: none" href="{{ route('profiles.edit', [$profile->id]) }}">Edit Profile</a>
                    @endcan
                </h5>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
            </div>
            <div class="pt-3"><strong>{{ $profile?->title }}</strong></div>
            <p>
                {{ $profile->user?->bio }}
            </p>
            <div>
                <a style="font-weight: bold;" href="{{ $profile->website }}">{{ $profile?->website ?? '' }}</a>
            </div>
        </div>
    </div>

    <div class="row pt-5">
        @if (count($profile->user->posts))
            @foreach ($profile->user->posts as $post)
                <div class="col-4">
                    <a href="{{ route('posts.show', [$post->id]) }}">
                        <img src="/storage/{{ $post->image }}"class="w-100">
                    </a>
                </div>
            @endforeach
        @endif

    </div>
</div>
@endsection
