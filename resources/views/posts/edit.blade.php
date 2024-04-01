@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('posts.update', $post->id) }}">
        @method('patch')
        @csrf
        コメント：<input type="text" name="comment" value="{{ $post->comment }}">
        <div><input type="submit" value="投稿"></div>
    </form>
@endsection