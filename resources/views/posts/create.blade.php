@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div>コメント:<input type="text" name="comment"></div>
        <div>画像：<input type="file" name="image"></div>
        <input type="submit" value="送信">
    </form>
@endsection