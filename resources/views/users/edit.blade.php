@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <a href="{{ route('users.show', $user->id) }}">[戻る]</a>
    <form method="post" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('patch')
        <div>名前:<input type="text" name="name" value="{{ $user->name }}"></div>
        <div>メールアドレス：<input type="text" name="email" value="{{ $user->email }}"></div>
        <div>プロフィール：</div>
        <div><textarea name="profile" cols="30" rows="10">{{ $user->profile }}</textarea></div>
        <input type="submit" value="更新">
    </form>
@endsection