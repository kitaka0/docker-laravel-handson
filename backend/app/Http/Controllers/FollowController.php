<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Follow;

class FollowController extends Controller
{
    // follow処理
		public function follow(Request $request) {
			$follow = new Follow();
		  $follow->user_id = Auth::id();
		  $follow->follow_id = $request->follow_id;
		  $follow->save();
			return redirect(url()->previous());
		}

		// Unfollow処理
		public function unFollow(Request $request) {
		  Follow::where('user_id',Auth::id())
		  				->where('follow_id',$request->follow_id)->delete();
		  return redirect(url()->previous());
		}
}
