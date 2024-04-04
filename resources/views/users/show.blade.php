@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
     @if (auth()->user()->id === $user->id)
        <a href="{{ route('users.edit', $user->id) }}">[編集]</a>
     @endif
    <p>名前：{{ $user->name }}</p>
    <p>プロフィール画像</p>
    <div class="post_body">
        <div class="post_body_img">
            @if ($user->image !== '')
                <img src="{{ asset('storage/'. $user->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
        </div>
    </div>
    @if (auth()->user()->id === $user->id)
        <a href="{{ route('users.edit_image', $user->id) }}">画像変更</a>        
    @endif
    <p>プロフィール：</p>
        @if ($user->profile)
            <p>{{ $user->profile }}</p>
        @else
            <p>プロフィールはありません</p>
        @endif
@endsection