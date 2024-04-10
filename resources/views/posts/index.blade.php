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
    <div class="grid">
        @forelse ($posts as $post)
        <div class="grid-item">
            @if ($post->image !== '')
                <img src="{{ asset('storage/' . $post->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
            <div class="save">
                <a href="{{ route('posts.edit', $post->id) }}" class="inside">編集</a>
            </div>
            <div class="link">
                <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form>
            </div>
            <div class="share">
                <a href="{{ route('posts.edit_image', $post->id) }}" class="inside">画像変更</a>
            </div>
            <div class="overlay"></div>
        </div>
        @empty
            <p>投稿はありません</p>
        @endforelse
    </div>    
@endsection
{{-- <ul>
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
</form> --}}