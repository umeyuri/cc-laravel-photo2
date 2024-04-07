@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        <h2>おすすめユーザー</h2>
        @forelse ($users as $user)
        <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
        @empty
            <p>おすすめのユーザーはいません</p>
        @endforelse
    </ul>
    <a href="{{ route('posts.create') }}">新規投稿</a>
    <div class="container">
    @forelse ($posts as $post)
    <div class="item post_body_img">
             {{ $post->comment }}({{ $post->created_at }})
            <a href="{{ route('posts.edit', $post->id) }}">[編集]</a>
            <form method="post" class="delete" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('delete')
                <input type="submit" value="削除">
            </form>
            @if ($post->image !== '')
                <img src="{{ asset('storage/' . $post->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
                    <a href="{{ route('posts.edit_image', $post->id) }}">画像の変更</a>
            <ul>
                @forelse ($post->comments as $comment)
                    <li>{{ $comment->user->name }}: {{ $comment->body }}</li>
                @empty
                    <p>コメントはありません</p>
                @endforelse
            </ul>
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                コメントを追加：<input type="text" name="body">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="submit" value="送信">
            </form>
        </div>
    @empty
        <p>投稿はありません</p>
    @endforelse
    </div>
@endsection