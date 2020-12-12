<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    // コメント投稿処理
		public function commentPost(Request $request) {
			$comment = new Comment();
			$comment->user_id = Auth::id();
			$comment->post_id = $request->post_id;
			$comment->body = $request->body;
			$comment->save();
			return redirect(url('/posts',$request->post_id));
		}

		// コメント投稿処理
		public function commentEdit() {

		}

		// コメント削除処理
		public function commentDelete() {

		}
}
