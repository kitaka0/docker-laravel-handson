@extends('layouts.default')

<!-- headタグ -->
@section('title', 'Portnest')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/userprofile.css') }}">
@endsection


<!-- メインコンテンツ -->
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
        <div class="follow mr-2">{{count($follows)}}<span>フォロー</span></div>
        <div class="follower">{{count($followers)}}<span>フォロワー</span></div>
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
        @if($follow==null)
          <form method="post" action="{{ url('follow') }}">
            {{ csrf_field() }}
            <input type="hidden" name="follow_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-light">フォロー</button>
          </form>
        @else
          <form method="post" action="{{ url('unfollow') }}">
            {{ csrf_field() }}
            <input type="hidden" name="follow_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-light">フォロー解除</button>
          </form>
        @endif
      </div>
    @endif
  </div>
</section>


<section class="post">
  <p>投稿一覧</p>
  @forelse($posts as $post)
  <div class="post-item">
    <dic class="post-user">
      <div class="">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
          <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        @endif
      </div>
      <div class="">
        <div>{{ $post->user_id }}</div>
        <div>{{$post->created_at}}</div>
      </div>
    </dic>
    <a href="{{ url('/posts',$post->id) }}">{{$post->title}}</a>
    <p><{{$post->detail}}</p>
  </div>
  @empty
    Nothing
  @endforelse
</section>



<!-- <h1>user_id:{{$user->id}}</h1>
@if($follow != null)
  followID:{{$follow->id}}
@endif
@forelse($posts as $post)
<div class="post">
  id:{{$post->id}}
  <a href="{{ url('/users',$post->user_id) }}">
    user_id:{{$post->user_id}}
  </a>
  url;{{$post->url}}
  time:{{$post->created_at}}
  title:{{$post->title}}
  detail:{{$post->detail}}
  <a href="{{ url('/posts',$post->id) }}">link</a>
</div>
@empty
  Nothing
@endforelse

<div class="">
  @if($follow==null)
  <form method="post" action="{{ url('follow') }}">
    {{ csrf_field() }}
    <input type="hidden" name="follow_id" value="{{$user->id}}">
    <button type="submit" class="btn btn-info">フォロー</button>
  </form>
  @else
    <p>フォロー済みです。</p>
  @endif
</div> -->
  
@endsection
