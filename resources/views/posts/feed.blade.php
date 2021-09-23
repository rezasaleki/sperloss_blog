@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
        <div class="row pt-5">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" alt="{{ $post->title }}" class="w-100">
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            {{-- <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->title }}" class="rounded-circle w-100" style="max-width: 60px"> --}}
                        </div>
                        <div>
                            <h2 class="font-weight-bold">
                                {{-- {{ route('profiles.show', [$post->user->id]) }} --}}
                                <a style="text-decoration: none" href="/profiles/{{ $post->user->id }}">
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a>
                            </h2>
                        </div>
                        <div class="pl-3">
                            Username : <a style="text-decoration: none" href="{{ route('profiles.show', [$post->user->profile->id]) }}"><span class="text-bold">{{ $post->user->name }}</span></a>
                        </div>
                    </div>
                    <hr>
                    <p>
                        {{-- {{ route('profiles.show', [$post->user->id]) }} --}}
                        <a style="text-decoration: none" href=""> <span class="text-dark">{{ $post->user->username }}</span> </a>: {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row pt-3">
        <div class="col-12 d-flex justify-content-center">
            {!! $posts->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection
