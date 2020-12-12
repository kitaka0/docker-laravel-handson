<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\PostPhoto;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

  // homeを表示
	public function newArrive() {
		//postsを基準にusersをjoin
		$posts = Post::join('users', 'posts.user_id', '=', 'users.id')
				            ->orderBy('post_id','desc')
				            ->get(['posts.id as post_id','posts.*', 'users.*']);
		return view('newarrive',['posts' => $posts]);
	}

	// rankingを表示
	public function ranking() {
		//postsを基準にusersをjoin
		$posts = Post::join('users', 'posts.user_id', '=', 'users.id')
				            ->get(['posts.id as post_id','posts.*', 'users.*']);
		// いいね数をカウントしpostsに追加
		for ($i=0; $i < count($posts); $i++) { 
			$post_id = $posts[$i]['post_id'];
			$like_count = Like::where('likes.post_id',$post_id)->count();
			$posts[$i]['like_count'] = $like_count;
		}
		// like_countで並び替え
		$posts = $posts->sortByDesc('like_count');
		return view('ranking',['posts' => $posts]);
	}

	// タイムライン画面を表示
	public function timeline() {
		// followとpostsを結合してフォローユーザー分だけ抜き出す
		$follow_post = DB::table('follows')
								->join('posts',function($join) {
									$join->on('follows.follow_id','=','posts.user_id')
									->where('follows.user_id','=',Auth::id());})
								->join('users','follows.follow_id','=','users.id')
								->select('posts.id as post_id','posts.*','users.*')
								->orderBy('post_id','desc')
								->get();
		return view('timeline',['posts' => $follow_post]);
	}

	// portfoio画面を表示
	public function postDetail(int $post_id) {
		$post = Post::where('posts.id', '=', $post_id)
						->join('users','posts.user_id', '=', 'users.id')
						->first(['posts.id as post_id','posts.*','users.*']);
		$post_photos = PostPhoto::where('post_id',$post_id)->get();
		$comments = Comment::where('post_id',$post_id)
												->join('users','comments.user_id','=','users.id')
												->get();
		$like = Like::where('user_id',Auth::id())->where('post_id',$post_id)
						->first();
		$like_count = Like::where('post_id',$post_id)->get()->count();
		return view('postdetail',['post'=>$post,'post_photos'=>$post_photos,'comments'=>$comments,'like'=>$like,'like_count'=>$like_count]);
	}

	// create画面
	public function create() {
		return view('create');
	}

	public function store(PostRequest $request) {
		// 投稿情報を保存
		$post = new Post();
    $post->post_title = $request->post_title;
    $post->product_title = $request->product_title;
    $post->detail = $request->detail;
    $post->url = $request->url;
		$post->user_id = Auth::id();
    $post->save();

    // 画像の保存
    $file_count = 0;
    if($request->file != null){
    	$file_count = count($request->file);
    }
    for ($i=0; $i<$file_count; $i++){
	    if($request->file[$i] != null){
	    	$filename = $post->id.'_'.$i;
	    	$path = $request->file[$i]->storeAs('public/photos', $filename);
				$path = str_replace('public/', '', $path);
		    $photo = new PostPhoto();
		    $photo->post_id = $post->id;
		    $photo->path = $path;
		    $photo->save();
	  	}
  	}
    return redirect('/');
	}

	// 編集画面
	public function postEdit(int $post_id) {
		$post = Post::where('id',$post_id)->first();
		$photos = PostPhoto::where('post_id',$post_id)->get();
		return view('postedit',['post'=>$post,'photos'=>$photos]);
	}

	// アップデート処理
	public function postUpdate(PostRequest $request) {
		// 投稿情報を保存
		$post = Post::where('id',$request->post_id)->first();
    $post->post_title = $request->post_title;
    $post->product_title = $request->product_title;
    $post->detail = $request->detail;
    $post->url = $request->url;
		$post->user_id = Auth::id();
    $post->save();

    // 画像の保存
    $file_count = 0;
    if($request->file != null){
    	$file_count = count($request->file);
    }
    for ($i=0; $i<$file_count; $i++){
	    if($request->file[$i] != null){
	    	$path = $request->file[$i]->store('public/photos');
				$path = str_replace('public/', '', $path);
		    $photo = new PostPhoto();
		    $photo->post_id = $post->id;
		    $photo->path = $path;
		    $photo->save();
	  	}
  	}
    return redirect('/');
	}

	public function postDelete(Request $request) {
		Post::where('id',$request->post_id)->delete();
		return redirect('/');
	}

}
