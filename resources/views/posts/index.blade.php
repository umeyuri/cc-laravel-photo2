@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <a href="{{ route('posts.create') }}">新規投稿</a>
    <ul>
    @forelse ($posts as $post)
        <li class="post">投稿者：{{ $post->user->name }}: {{ $post->comment }}({{ $post->created_at }})
            <a href="{{ route('posts.edit', $post->id) }}">[編集]</a>
            <form method="post" class="delete" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('delete')
                <input type="submit" value="削除">
            </form>
            <div class="post_body">
                <div class="post_body_img">
                    @if ($post->image !== '')
                        <img src="{{ asset('storage/' . $post->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                </div>
            </div>
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
        </li>
    @empty
        <p>投稿はありません</p>
    @endforelse
    </ul>
@endsection