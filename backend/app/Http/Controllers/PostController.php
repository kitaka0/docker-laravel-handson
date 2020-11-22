<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

  // Trend(home)を表示
	public function trend() {
		//postsを基準にusersをjoin
		$posts = DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
				            ->select('posts.id as post_id','posts.*', 'users.*')
				            ->get();
		return view('trend',['posts' => $posts]);
	}

	// portfoio画面を表示
	public function postDetail(Post $post) {
		$post_ = DB::table('posts')
						->join('users', function ($join) use($post) {
							$join->on('posts.user_id', '=', 'users.id')
							->where('posts.id', '=', $post->id);})
						->select('posts.id as post_id','posts.*','users.*')
						->first();
		return view('postdetail',['post' => $post_]);
	}

	// create画面
	public function create() {
		return view('create');
	}

	public function store(Request $request) {
		$post = new Post();
    //createビューの情報をDBに保存
    $post->post_title = $request->post_title;
    $post->product_title = $request->product_title;
    $post->detail = $request->detail;
    $post->url = $request->url;
		$post->user_id = Auth::id();
    $post->save();
    return redirect('/');
	}

}
