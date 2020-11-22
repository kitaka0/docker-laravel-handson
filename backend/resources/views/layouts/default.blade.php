<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
  <!-- BootStrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <!-- ICON -->
  <link rel="icon" type="image/x-icon" href="{{ asset('/img/icon.png') }}">
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/default.css') }}">
  @yield('css')

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>
<body>
	<!-- Header -->
  <header class="header">
    <div class="logo">
      <a href="/">
        <img src="{{ asset('/img/logo.png') }}">
      </a>  
    </div>
    <div class="header-right">
      <form class="search">
        <input type="text" name="search">
      </form>
      @if (Route::has('login'))
        <div>
        @auth
				<!-- Settings Dropdown -->
				<div class="hidden sm:flex sm:items-center sm:ml-6">
				  <x-jet-dropdown align="right" width="48">
				    <x-slot name="trigger">
				      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
				        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
				            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
				        </button>
				    	@else
				        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
				            <div>{{ Auth::user()->name }}</div>

				            <div class="ml-1">
				                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
				                </svg>
				            </div>
				        </button>
				    	@endif
						</x-slot>
						<x-slot name="content">
						  <!-- Account Management -->
						  <div class="block px-4 py-2 text-xs text-gray-400">
						      {{ __('Manage Account') }}
						  </div>
						  <x-jet-dropdown-link href="{{ url('users',Auth::user()->id) }}">
						      {{ __('Profile') }}
						  </x-jet-dropdown-link>
						  @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
						      <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
						          {{ __('API Tokens') }}
						      </x-jet-dropdown-link>
						  @endif        
						  <!-- Authentication -->
						  <form method="POST" action="{{ route('logout') }}">
				        @csrf
				        <x-jet-dropdown-link href="{{ route('logout') }}"
				                            onclick="event.preventDefault();
				                                        this.closest('form').submit();">
				            {{ __('Logout') }}
				        </x-jet-dropdown-link>
				      </form>
				    </x-slot>
				  </x-jet-dropdown>
				</div>
        @else
          <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
          @endif
        @endif
        </div>
      @endif
      <form method="get" action="{{ url('/posts/create')}}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-info">投稿</button>
      </form>
    </div>
  </header>
  
	<div class="main">
		<!-- 左サイドバー -->
		@yield('grovalNavigation')
    <!-- メインコンテンツ -->
		<div class="content">
    	@yield('content')
    </div>
    <!-- 右サイドバー -->
    @yield('localNavigation')
  </div>

  
</body>
</html>