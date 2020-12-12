@section('grovalNavigation')
<div class="grovalNavigation">
  <div class="groval-text">
   <a href="{{ route('newArrive') }}">新着</a>
   <a href="{{ route('ranking') }}">ランキング</a>
   <a href="{{ route('timeline') }}">タイムライン</a>
   @auth
     <a href="{{ route('userProfile',['user_id'=>Auth::user()->id]) }}">プロフィール</a>
   @endif
  </div>
</div>
@endsection