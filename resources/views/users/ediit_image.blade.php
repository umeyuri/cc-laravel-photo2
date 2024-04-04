@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    <div class="post_body">
        <div class="post_body_img">
            @if ($user->image !== '')
                <img src="{{ asset('storage/' . $user->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
        </div>
    </div>
    <form method="post" action="{{ route('users.update_image', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>画像を選択：<input type="file" name="image"></div>
        <input type="submit" value="更新">
    </form>
    <a href="{{ route('users.show', $user->id) }}">[戻る]</a>
@endsection