<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '清风理财')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
  </head>
  <body>
    @include('layouts._header')

    <div class="container">
      <div class="col-lg-12">
        @include('shared.messages')
        @yield('content')
        @include('layouts._footer')
      </div>
    </div>
    <script src="/js/app.js"></script>
  </body>
</html>