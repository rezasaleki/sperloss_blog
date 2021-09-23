@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>CreateAt</th>
                    <th>Operation</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="/storage/{{ $post->thumbnail }}" class="w-100 rounded-circle"></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td style="white-space: nowrap;">
                            <a class="btn btn-info" href="{{ route('posts.edit', [$post->id]) }}">Edit</a>
                            <a class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Delete</a>
                        </td>
                    </tr>
                    <form id="delete-form" action="{{ route('posts.destroy', [$post->id]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
