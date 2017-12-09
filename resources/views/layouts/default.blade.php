<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '清风理财')</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    @yield('script')
  </head>
  <body>
    @include('layouts._header')
        @include('shared.messages')
        @yield('content')
    @include('layouts._footer')
    <!-- // <script src="js/app.js"></script> -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/sweetalert.js"></script>
    @include('sweet::alert')
  </body>
</html>