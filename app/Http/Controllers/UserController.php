<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PostImageRequest;

class UserController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        $recommends = Post::recommend($user->id)->get();
        
        return view('users.show', [
            'title' => 'ユーザープロフィール',
            'user' => $user,
            'recommends' => $recommends,
        ]);
    }

    public function edit($id) {
        $user = User::find($id);
        //ログインユーザでない場合はプロフィール編集画面の表示はしない
        if (\Auth::user()->id !== $user->id) {
            return redirect()->route('posts.index');
        }
        return view('users.edit', [
            'user' => $user,
            'title' => 'プロフィール編集画面',
        ]);
    }

    public function update(UserRequest $request, $id) {
        $user = User::find($id);
        $user->update($request->only(['name', 'email', 'profile']));
        session()->flash('success', 'プロフィールを更新しました');

        return redirect()->route('users.show', $user->id);
    }

    public function editImage($id) {
        $user = User::find($id);
        //ログインユーザでない場合は画像編集画面の表示はしない
        if (\Auth::user()->id !== $user->id) {
            return redirect()->route('posts.index');
        }
        return view('users.ediit_image', [
            'title' => '画像変更画面',
            'user' => $user,
        ]);
    }

    public function updateImage(PostImageRequest $request, $id) {
        // リクエストの中に画像がアップロードされていたら、ローカルに保存
        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('photos', 'public');
        }
        //　その後古い画像の削除
        $user = User::find($id);
        if ($user->image !== '') {
            \Storage::disk('public')->delete($user->image);
        }

        // その後、usersテーブルに上書き保存
        $user->update([
            'image' => $path,
        ]);

        session()->flash('success', '画像を更新しました');
        
        return redirect()->route('users.show', $user->id);
    }
}
