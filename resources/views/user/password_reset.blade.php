@extends('layouts.default')
@section('title', '重置密码')
@section('title1', '重置密码')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">重置密码</div>
        <div class="panel-body">
          @include('shared.errors')
          <form method="POST" action="{{ route('password.reset') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="mobile">手机号码：</label>
                <input type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}">
                <input id="btn" class=" btn btn-info" type="button" value="免费获取验证码"/>
            </div>

            <div class="form-group">
            <label for="verification_code">验证码：</label>
            <input type="text" name="verification_code" class="form-control" value="{{ old('verification_code') }}">
            </div>

            <div class="form-group">
            <label for="password">请输入密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>

            <div class="form-group">
            <label for="password_confirmation">确认新密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  重置
                </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop