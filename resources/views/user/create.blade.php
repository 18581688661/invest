@extends('layouts.default')
@section('title', '用户注册')
@section('content')
<div class="container">
    <div class="col-lg-6">
      <div class="">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>用户注册</h5>
        </div>
        <div class="panel-body">
      @include('shared.errors')
      <form method="POST" action="{{ route('user.store') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="username">用户名：</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
          </div>
          <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="verification_code">验证码：</label>
            <input type="text" name="verification_code" class="form-control" value="{{ old('verification_code') }}">
          </div>
          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>
          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>
          <button type="submit" class="btn btn-primary">注册</button>
          <button type="submit" class="btn btn-success">注册</button>
      </form>
        </div>
      </div>
      </div>
    </div>
    <div class="col-lg-6">
      <img src="/images/cd1.jpg" height="420" width="620" />
    </div>
</div>
@stop