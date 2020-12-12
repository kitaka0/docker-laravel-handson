@extends('layouts.profile')

<!-- headタグ -->
@section('css')
<link rel="stylesheet" href="{{ asset('/css/userprofile.css') }}">
@endsection


@section('profile_under')
<section class="follow">
  <p>フォロー一覧</p>
  @forelse($follows as $follow)
  <dic class="follow-user">
    <a href="{{ url('/users',$follow->id) }}">
    <div class="follow-img">
      @if ($follow->profile_photo_path!=null)
        <img class="h-8 w-8 rounded-full object-cover" src="storage/profile-photos/{{$follow->profile_photo_path}}" alt="{{ $follow->name }}" />
      @else
        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{$follow->name}}&amp;color=7F9CF5&amp;background=EBF4FF" alt="{{ $follow->name }}" />
      @endif
    </div>
    </a>
    <div>{{$follow->name}}</div>
    <div class="user-follow">
      @if($follow->is_each_follow==null)
        <form method="post" action="{{ url('follow') }}">
          {{ csrf_field() }}
          <input type="hidden" name="follow_id" value="{{$follow->id}}">
          <button type="submit" class="btn btn-light">フォロー</button>
        </form>
      @else
        <form method="post" action="{{ url('unfollow') }}">
          {{ csrf_field() }}
          <input type="hidden" name="follow_id" value="{{$follow->id}}">
          <button type="submit" class="btn btn-light">フォロー解除</button>
        </form>
      @endif
    </div>
  </dic>
  @empty
    Nothing
  @endforelse
</section>
  
@endsection
