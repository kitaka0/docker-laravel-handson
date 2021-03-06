@extends('layouts.profile')

<!-- headタグ -->
@section('css')
<link rel="stylesheet" href="{{ asset('/css/userprofile.css') }}">
@endsection

<!-- メインコンテンツ -->
@section('profile_under')

<section class="post">
  <p>投稿一覧</p>
  @forelse($posts as $post)
  <div class="post-item">
    <dic class="post-user">
      <div class="user-img">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img class="rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
  
@endsection
