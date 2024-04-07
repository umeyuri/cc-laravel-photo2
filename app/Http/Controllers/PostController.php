<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //これがリレーション設定で簡単に記載できる。
        // $posts = Post::where('user_id', \Auth::user()->id)->get();        
        //$posts = \Auth::user()->posts()->latest()->get();
        //dd(Post::recommend()->toSql());
        $users = User::recommend(\Auth::user()->id)->get();
        $posts = \Auth::user()->posts()->latest()->get();

        return view('posts.index', [
            'title' => '投稿一覧',
            'posts' => $posts,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'title' => '新規投稿',
        ]);
    }

    /**
     * 
     * 
     */
    public function store(PostRequest $request)
    {
        $path = '';
        $image = $request->file('image');
        if (isset($image)) {
            $path = $image->store('photos', 'public'); //publicの中のphotosディレクトリ(storage/)
        }

        Post::create([
            'user_id' => \Auth::user()->id,
            'comment' => $request->comment,
            'image' => $path,
        ]);

        session()->flash('success', '投稿を追加しました');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'title' => '投稿詳細',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'title' => '投稿編集',
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->only(['comment']));

        session()->flash('success', '更新しました');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image !== '') {
            \Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        session()->flash('success', '削除しました');

        return redirect()->route('posts.index');
    }

    public function editImage($id) {
        $post = Post::find($id);

        return view('posts.edit_image', [
            'post' => $post,
            'title' => '画像変更画面'
        ]);
    }

    public function updateImage(PostImageRequest $request, $id) {
        $path = '';
        //投稿された画像データの保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('photos', 'public');
        }
        //古い画像データの削除
        $post = Post::find($id);
        if ($post->image !== '') {
            \Storage::disk('public')->delete($post->image);
        }
        //ファイルパスをポストのimageカラムに保存
        // $post->update(['image' => $path]);
        $post->image = $path;
        $post->save();
        
        session()->flash('success', '画像を更新しました');
        return redirect()->route('posts.index');
    }
}
