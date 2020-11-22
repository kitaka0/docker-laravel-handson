@extends('layouts.default')

<!-- headタグ -->
@section('title', 'Portnest')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/postdetail.css') }}">
@endsection


<!-- メインコンテンツ -->
@section('content')

<section class="post">
  <div class="post-item">
  	<div class="post-title">
  		<h1>{{$post->post_title}}</h1>
  	</div>
    <div class="post-user">
      <a href="{{ url('/users',$post->id) }}">
        <div class="post-user-icon">
          @if ($post->profile_photo_path!=null)
            <img class="h-8 w-8 rounded-full object-cover" src="storage/{{$post->profile_photo_path}}" alt="{{ $post->name }}" />
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
    <div class="post-text">
      <p>制作物:{{$post->product_title}}</p>
      <p>URL:{{$post->url}}</p>
      <p>{!! nl2br(e($post->detail)) !!}</p>
    </div>
  </div>
</section>

@endsection
 