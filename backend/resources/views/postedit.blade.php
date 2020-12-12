@extends('layouts.default')

<!-- headタグ -->
@section('title', 'Portnest')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('/css/create.css') }}">
<script type="text/javascript" src="{{ asset('/js/slick.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/fileup.js') }}"></script>
@endsection

<!-- メインコンテンツ -->
@section('content')
<form method="post" action="{{ route('postUpdate') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="text" class="post_title" name="post_title" placeholder="記事のタイトル　例:マルバツゲームをpythonで作ってみた" value="{{ old('post_title' ,$post->post_title)}}">
  @error('post_title')
    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
  <input type="text" class="product_title" name="product_title" placeholder="成果物のタイトル　例:マルバツゲーム" value="{{ old('product_title' ,$post->product_title)}}">
  @error('product_title')
    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
  <input type="text" class="url" name="url" placeholder="成果物のurl (任意)" value="{{ old('url' ,$post->url)}}">

  <div class="view_box_main">
    <div class="img_view_main">
      <p><img src="{{asset('img/defaultImage.png')}}"></p>
    </div>
  </div>
  <div class="img_input">
    <div class="view_box_small">
      <label>画像1</label>
      <input type="file" class="file" name="file[0]">
      <div class="img_view_small">
        <p><img src="{{asset('img/defaultImage.png')}}"></p>
      </div>
    </div>
  </div>
  
  <textarea class="detail" name="detail" placeholder="工夫点や動機など好きなことを書こう">{{ old('detail' ,$post->detail)}}</textarea>
  <input type="hidden" name="post_id" value="{{$post->id}}">
  <button type="submit" class="btn btn-info post-btn">投稿</button>
</form>

<script>
    $('.slider').slick({
      arrows:true,
      dots:true,
      infinite: false,
    });
  </script>
  
@endsection