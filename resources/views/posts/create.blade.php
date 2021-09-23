@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6 pb-3">
                                <input id="title"
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="activated" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6 pb-3">
                                <select name="activated" class="form-control" {{ old('activated') }}>
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                                @error('activated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6 pb-3">
                                <input id="image"
                                    type="file"
                                    class="form-control-file @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}" autocomplete="image">

                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="thumbnail" class="col-md-4 col-form-label text-md-right">{{ __('thumbnail') }}</label>

                            <div class="col-md-6 pb-3">
                                <input id="thumbnail"
                                    type="file"
                                    class="form-control-file @error('thumbnail') is-invalid @enderror"
                                    name="thumbnail" value="{{ old('thumbnail') }}" autocomplete="thumbnail">

                                @if($errors->has('thumbnail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('thumbnail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6 pb-3">
                                <textarea id="content" class="form-control" @error('content') is-invalid @enderror name="content" rows="7" autocomplete="content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa, doloribus, ad corrupti nihil hic quasi saepe ipsum dolores et adipisci explicabo exercitationem autem praesentium fuga distinctio ullam corporis error veniam!</textarea>

                                @if($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
