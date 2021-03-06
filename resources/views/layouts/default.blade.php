<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '清风理财')</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link rel="stylesheet" href="/css/buttons.css">
    <link href="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.css" rel="stylesheet">
    <link href="css/component.css" rel="stylesheet">
    
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=9mGs9G3Lo7nEqqsGGWrpP1BHFUYI3Al5"></script>
    <style type="text/css"> 
    #allmap { 
        width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑"; 
    } 
    </style>
  </head>
    <body>
        @include('layouts._header')
            @include('shared.messages')
            @yield('content')
        @include('layouts._footer')
    <!-- // <script src="js/app.js"></script> -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/sweetalert.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/modalEffects.js"></script>
    <script src="js/GeoUtils_min.js"></script>

    @include('sweet::alert')
    @yield('script')
    <!-- @include('pjax::pjax') -->
  </body>
</html>