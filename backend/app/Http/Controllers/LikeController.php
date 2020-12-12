<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Like;

class LikeController extends Controller
{
    // いいね
		public function like(Request $request) {
			$like = new Like();
			$like->user_id = Auth::id();
			$like->post_id = $request->post_id;
			$like->save();
			return redirect(url('/posts',$request->post_id));
		}

		// いいね解除
		public function unlike(Request $request) {
			Like::where('user_id',Auth::id())
		  				->where('post_id',$request->post_id)->delete();
		  return redirect(url('/posts',$request->post_id));
		}
}
