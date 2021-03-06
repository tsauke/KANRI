<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>KANRI</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">KANRI</a>
      <div class="my-navbar-control">
        @if(Auth::check())
          <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
          ｜
          <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        @else
          <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
          ｜
          <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        @endif
      </div>
    </nav>
  </header>
<main>
  @yield('content')
</main>
@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
@yield('scripts')
</body>
</html>