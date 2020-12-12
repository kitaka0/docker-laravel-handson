@extends('layouts.default')

<!-- headタグ -->
@section('title', $post->product_title)
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/slick-theme.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/postdetail.css') }}">
<script type="text/javascript" src="{{ asset('/js/slick.js') }}"></script>
@endsection


<!-- メインコンテンツ -->
@section('content')
<section class="post">
  <div class="post-item">
  	<div class="post-title">
  		<h1>{{$post->post_title}}</h1>
  	</div>
  	<div class="post-user-dropdown">
	    <div class="post-user">
	      <a href="{{ url('/users',$post->id) }}">
	        <div class="post-user-icon">
	          @if ($post->profile_photo_path!=null)
	            <img class="h-8 w-8 rounded-full object-cover" src="/storage/{{$post->profile_photo_path}}" alt="{{ $post->name }}" />
	          @else
	            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{$post->name}}&amp;color=7F9CF5&amp;background=EBF4FF" alt="{{ $post->name }}" />
	          @endif
	        </div>
	      </a>
	      <div class="post-con">
	        <div class="post-name">{{ $post->name }}</div>
	        <div class="post-date">{{$post->created_at}}</div>
	      </div>
	    </div>
	    @if($post->user_id==Auth::id())
    	<div class="post-dropdown">
		    <button type="submit" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      三
		    </button>
		    <div class="dropdown-menu">
		      <form method="get" action="{{ route('postEdit',['post_id'=>$post->post_id]) }}">
		      	{{ csrf_field() }}
		      	<input type="hidden" name="post_id" value="{{$post->post_id}}">
		      	<button type="submit" class="btn dropdown-item">編集</button>
		    	</form>
		    	<form action="{{route('postDelete', $post->post_id)}}" method="post" class="float-right">
						{{ csrf_field() }}
						@method('delete')
						<input type="submit" value="削除" class="btn dropdown-item" onclick='return confirm("削除しますか？");'>
					</form>
		    </div>
    	</div>
	    @endif
	  </div>
    <div class="post-text">
      <p>制作物:{{$post->product_title}}</p>
      <p>URL:{{$post->url}}</p>
      <ul class="slider">
      	@forelse($post_photos as $post_photo)
	 			<li class="slider-li"><div class="slider-li">
	 				<img src="/storage/{{$post_photo->path}}" alt="{{ $post_photo->path }}" /></div>
	 			</li>
	 			@empty
	 			<li class="slider-li"><div class="slider-li">
	 				<img src="{{ asset('img/defaultImage.png') }}" alt="nothing" /></div>
	 			</li>
	 			@endforelse	
			</ul>
      <p>{!! nl2br(e($post->detail)) !!}</p>
    </div>
  </div>
</section>

<section class="like">
	<div class="like-img">
		@if($like==null)
      <form method="post" action="{{ url('like') }}">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{$post->post_id}}">
        <button type="submit" class="btn btn-light">いいね</button>
      </form>
    @else
      <form method="post" action="{{ url('unlike') }}">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{$post->post_id}}">
        <button type="submit" class="btn btn-light">いいね解除</button>
      </form>
    @endif
	</div>
	<div class="like-count">
		<p>{{$like_count}}</p>
	</div>
</section>

<section class="comment">
	<div class="comments">
		@forelse($comments as $comment)
			<p>{{$comment->name}}</p>
			<p>{!! nl2br(e($comment->body)) !!}</p>
		@empty
			nothing
		@endforelse
	</div>
	<form method="post" action="{{ url('comments/post')}}">
  	{{ csrf_field() }}
		<textarea name="body" placeholder="コメントを投稿しましょう"></textarea>
		<input type="hidden" name="post_id" value="{{$post->post_id}}">
		<input type="submit" value="送信">
	</form>
</section>

<script type="text/javascript">
	$('.slider').slick({
    arrows: true,
    dots: true,
  });
</script>



@endsection
 