@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div class="post_body">
    @if ($post->image !== '')
        <img class="post_body" src="{{ asset('storage/' . $post->image) }}">
    @else
        <img class="post_body" src="{{ asset('images/no_image.png') }}">
    @endif
    </div>
    <form method="post" action="{{ route('posts.update_image', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div><label>画像を選択：<input type="file" name="image"></label></div>
        <input type="submit" value="更新"> 
    </form>
@endsection