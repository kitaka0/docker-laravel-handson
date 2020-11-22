<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;

class UserController extends Controller
{
    // プロフィール画面
		public function userProfile(int $userid) {
			$post = Post::get()->where('user_id',$userid);
			$user = User::where('id',$userid)->first();
			// フォロー判定
			$follow = Follow::get()->where('user_id',Auth::id())->where('follow_id',$userid)->first();
			$follows = Follow::get()->where('user_id',$userid);
			$followers = Follow::get()->where('follow_id',$userid);
			return view('userprofile',['posts' => $post,'user'=>$user,'follow'=>$follow,'follows'=>$follows,'followers'=>$followers]);
		}

}
