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
    @auth
        @if (auth()->user()->id === $user->id)
            <a href="{{ route('users.edit_image', $user->id) }}">画像変更</a>        
        @endif
    @endauth
    <p>プロフィール：</p>
        @if ($user->profile)
            <p>{{ $user->profile }}</p>
        @else
            <p>プロフィールはありません</p>
        @endif
    <h2>{{ $user->name }}のおすすめ投稿</h2>
    <ul>
        @forelse ($recommends as $recommend_post)
            <li class="post">{{ $recommend_post->comment }}({{ $recommend_post->created_at }})
                <a href="{{ route('posts.edit', $recommend_post->id) }}">[編集]</a>
                <form method="post" class="delete" action="{{ route('posts.destroy', $recommend_post->id) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form>
                <div class="post_body">
                    <div class="post_body_img">
                        @if ($recommend_post->image !== '')
                            <img src="{{ asset('storage/' . $recommend_post->image) }}">
                        @else
                            <img src="{{ asset('images/no_image.png') }}">
                        @endif
                        <a href="{{ route('posts.edit_image', $recommend_post->id) }}">画像の変更</a>
                    </div>
                </div>
                <ul>
                    @forelse ($recommend_post->comments as $comment)
                        <li>{{ $comment->user->name }}: {{ $comment->body }}</li>
                    @empty
                        <p>コメントはありません</p>
                    @endforelse
                </ul>
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    コメントを追加：<input type="text" name="body">
                    <input type="hidden" name="post_id" value="{{ $recommend_post->id }}">
                    <input type="submit" value="送信">
                </form>
            </li>
        @empty
            <p>投稿はありません</p>
        @endforelse
        </ul>
@endsection