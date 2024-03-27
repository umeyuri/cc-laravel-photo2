<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function index() {
        return view('follows.index', [
            'title' => 'フォロー一覧',
        ]);
    }

    public function store() {

    }

    public function destroy() {

    }

    public function followerindex() {
        return view('follows.follower_index', [
            'title' => 'フォロワー一覧',
        ]);
    }
}
