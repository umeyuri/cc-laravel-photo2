@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div class="grid">
        @forelse ($like_posts as $post)
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
            <p>いいねした投稿はありません</p>
        @endforelse
    </div>    
@endsection