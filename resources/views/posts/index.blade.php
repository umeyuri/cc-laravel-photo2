@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
    @forelse ($posts as $post)
        <li>{{ $post->comment }}({{ $post->created_at }})</li>
    @empty
        <p>投稿はありません</p>
    @endforelse
    </ul>
@endsection