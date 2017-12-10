@extends('layouts.default')
@section('title', '用户登录')
@section('content')
<div class="container">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h5>用户登录<a class="btn btn-sm btn-success" href="{{ route('mana_login') }}" role="button">管理员登录</a>
        </h5>
      </div>
      <div class="panel-body">
        @include('shared.errors')

        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="username">用户名：</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
          </div>

          <div class="form-group">
            <label for="password">密码（<a href="{{ route('password.reset') }}">忘记密码</a>）：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember">记住我</label>
          </div>

          <button type="submit" class="btn btn-primary">登录</button>
        </form>
        <hr>
        <p>还没有账号？<a href="{{ route('signup') }}">现在注册！</a></p>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <img src="/images/invest.jpg" height="420" width="620" />
  </div>
</div>
@stop