@extends('layouts.profile')

<!-- headタグ -->
@section('css')
<link rel="stylesheet" href="{{ asset('/css/userprofile.css') }}">
@endsection

<!-- メインコンテンツ -->
@section('profile_under')
<section class="like">
  <p>いいね一覧</p>
  @forelse($likes as $like)
  <div class="like-item">
    <dic class="like-user">
      <div class="user-img">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img class="rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        @endif
      </div>
      <div class="">
        <div>{{ $like->user_id }}</div>
        <div>{{$like->created_at}}</div>
      </div>
    </dic>
    <a href="{{ url('/posts',$like->id) }}">{{$like->title}}</a>
    <p><{{$like->detail}}</p>
  </div>
  @empty
    Nothing
  @endforelse
</section>
  
@endsection
