<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class UserController extends Controller
{
    // プロフィール画面
		public function userProfile(int $userid) {
			$post = Post::get()->where('user_id',$userid);
			$user = User::where('id',$userid)->first();
			// フォロー判定
			$is_follow = Follow::get()->where('user_id',Auth::id())->where('follow_id',$userid)->first();
			$following_count = Follow::get()->where('user_id',$userid)->count();
			$followers_count = Follow::get()->where('follow_id',$userid)->count();
			return view('userprofile',['posts' => $post,'user'=>$user,'is_follow'=>$is_follow,'following_count'=>$following_count,'followers_count'=>$followers_count]);
		}

		// フォロー一覧
		public function following(int $userid) {
			$follows = Follow::where('user_id',$userid)
								->join('users','follows.follow_id','=','users.id')
								->get(['follows.id as follow_id_','follows.*','users.*']);
			//各ユーザーのフォロー判定
			for ($i=0; $i < count($follows); $i++) { 
				$each_follow_id = $follows[$i]['follow_id'];
				$each_follow = Follow::where('user_id',Auth::id())->where('follow_id',$each_follow_id)->first();
				if($each_follow!=null){
					$is_each_follow = true;
				}else {
					$is_each_follow = false;
				}
				$follows[$i]['is_each_follow'] = $each_follow!=null;
			} 			
			
			$post = Post::get()->where('user_id',$userid);
			$user = User::where('id',$userid)->first();
			// 表示中ユーザーのフォロー判定
			$is_follow = Follow::get()->where('user_id',Auth::id())->where('follow_id',$userid)->first();
			$following_count = Follow::get()->where('user_id',$userid)->count();
			$followers_count = Follow::get()->where('follow_id',$userid)->count();
			return view('following',['posts' => $post,'user'=>$user,'is_follow'=>$is_follow!=null,'follows'=>$follows,'following_count'=>$following_count,'followers_count'=>$followers_count]);
		}

		//　フォロワー一覧
		public function followers(int $userid) {
			$followers = Follow::where('follow_id',$userid)
								->join('users','follows.user_id','=','users.id')
								->get(['follows.id as follow_id_','follows.*','users.*']);
			//各ユーザーのフォロー判定
			for ($i=0; $i < count($followers); $i++) { 
				$each_follow_id = $followers[$i]['user_id'];
				$each_follow = Follow::where('user_id',Auth::id())->where('follow_id',$each_follow_id)->first();
				if($each_follow!=null){
					$is_each_follow = true;
				}else {
					$is_each_follow = false;
				}
				$followers[$i]['is_each_follow'] = $each_follow!=null;
			}
			
			$post = Post::get()->where('user_id',$userid);
			$user = User::where('id',$userid)->first();
			// 表示中ユーザーのフォロー判定
			$is_follow = Follow::get()->where('user_id',Auth::id())->where('follow_id',$userid)->first();
			$following_count = Follow::get()->where('user_id',$userid)->count();
			$followers_count = Follow::get()->where('follow_id',$userid)->count();
			return view('followers',['posts' => $post,'user'=>$user,'is_follow'=>$is_follow!=null,'followers'=>$followers,'following_count'=>$following_count,'followers_count'=>$followers_count]);
		}

		// いいね一覧
		public function likes(int $userid) {
			$user = User::where('id',$userid)->first();
			// 表示中ユーザーのフォロー判定
			$is_follow = Follow::get()->where('user_id',Auth::id())->where('follow_id',$userid)->first();
			$following_count = Follow::get()->where('user_id',$userid)->count();
			$followers_count = Follow::get()->where('follow_id',$userid)->count();

			$likes = Like::where('likes.user_id',$userid)
										->join('users','likes.user_id','=','users.id')
										->join('posts','likes.post_id','=','posts.id')
										->get();
			return view('likes',['user'=>$user,'likes'=>$likes,'is_follow'=>$is_follow!=null,'following_count'=>$following_count,'followers_count'=>$followers_count]);
		}

}
