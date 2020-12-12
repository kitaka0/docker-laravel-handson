@section('title', $user->name)

@extends('layouts.default')

@section('content')
<section class="user">
  <div class="user-area">
    <div class="user-img">
      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img class="rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
      @endif
    </div>
    <div class="user-info">
      <div class="user-name">{{$user->name}}</div>
      <div class="user-follow pt-3">
        <a href="{{ route('following',['user_id'=>$user->id]) }}">
          <div class="follow mr-2">{{$following_count}}<span>フォロー</span></div>
        </a>
        <a href="{{ route('followers',['user_id'=>$user->id]) }}">
          <div class="follower">{{$followers_count}}<span>フォロワー</span></div>
        </a>
      </div>
    </div>
    @if($user->id==Auth::id())
    <div class="user-edit">
      <form method="get" action="{{ route('profile.show') }}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-light">プロフィール編集</button>
      </form>
    </div>
    @else
      <div class="user-follow">
        @if($is_follow)
          <form method="post" action="{{ url('unfollow') }}">
            {{ csrf_field() }}
            <input type="hidden" name="follow_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-light">フォロー解除</button>
          </form>
        @else
          <form method="post" action="{{ url('follow') }}">
            {{ csrf_field() }}
            <input type="hidden" name="follow_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-light">フォロー</button>
          </form>
        @endif
      </div>
    @endif
  </div>
  <hr>
  <div class="link-area">
  	<a href="{{route('userProfile',['user_id'=>$user->id])}}">
	  	<div class="home">
	  		Home
	  	</div>
	  </a>
	  <a href="{{route('likes',['user_id'=>$user->id])}}">
	  	<div class="likes">
	  		Likes
	  	</div>
	  </a>
  </div>
</section>

@yield('profile_under')

@endsection

