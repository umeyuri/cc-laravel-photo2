@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    @forelse ($follow_users as $user)
    <div class="post_body">
    <div class="post_body_img">
        @if ($user->image !== '')
            <img src="{{ asset('storage/'. $user->image) }}">
        @else
            <img src="{{ asset('images/no_image.png') }}">
        @endif
    </div>
    </div>
    @if (\Auth::user()->isFollowing($user))
    <form method="post" action="{{ route('follows.destroy', $user->id)}}">
        @csrf
        @method('delete')
        <input type="submit" value="フォロー解除">
    </form>
    @else
    <form method="post" action="{{ route('follows.store') }}">
        @csrf
        <input type="hidden" name="follow_id" value="{{ $user->id }}">
        <input type="submit" value="フォロー">
    </form>
    @endif
    @empty
        
    @endforelse
@endsection