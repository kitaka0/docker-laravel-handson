@extends('layouts.default')

<!-- headタグ -->
@section('title', 'Portnest')
@section('css')
<link rel="stylesheet" href="{{ asset('/css/create.css') }}">
@endsection

<!-- メインコンテンツ -->
@section('content')

<form method="post" action="{{ url('posts')}}">
  {{ csrf_field() }}
  <p><input type="text" name="post_title" placeholder="記事タイトル"></p>
  <p><input type="text" name="product_title" placeholder="成果物タイトル"></p>
  <p><input type="text" name="url" placeholder="url(任意)"></p>
  <p><textarea name="detail" placeholder="説明"></textarea></p>
  <p><input type="submit" value="Add"></p>
</form>
  
@endsection
