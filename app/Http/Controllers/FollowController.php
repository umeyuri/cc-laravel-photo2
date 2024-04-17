<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    public function index() {
        $follow_users = \Auth::user()->follow_users;

        return view('follows.index', [
            'title' => 'フォロー一覧',
            'follow_users' => $follow_users,
        ]);
    }

    public function store(Request $request) {
        Follow::create([
            'user_id' => \Auth::user()->id,
            'follow_id' => $request->follow_id,
        ]);
        session()->flash('success', 'フォローしました');

        return redirect()->route('posts.index');
    }

    public function destroy($id) {
        $follow_user = User::find($id);
        //フォロー解除
        //これだと中間テーブルを通してUserテーブルも合わせて削除してしまっている
        //\Auth::user()->follow_users()->where('follow_id', $follow_user->id)->delete();
        \Auth::user()->follows()->where('follow_id', $follow_user->id)->delete();
        session()->flash('success', 'フォロー解除しました');

        return redirect()->route('posts.index');
    }

    public function followerindex() {
        $followers = \Auth::user()->followers;
        
        return view('follows.follower_index', [
            'title' => 'フォロワー一覧',
            'followers' => $followers,
        ]);
    }
}
