@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li><a href="{{ route('posts.index') }}">投稿一覧</a></li>
        <li><a href="{{ route('like.index') }}">いいねリスト</a></li>
        <li>ユーザープロフィール</li>
        <li>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection