<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '清风理财')</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    @yield('script')
  </head>
  <body>
    @include('layouts._header')
        @include('shared.messages')
        @yield('content')
    @include('layouts._footer')
    <script src="/js/app.js"></script>
  </body>
</html>