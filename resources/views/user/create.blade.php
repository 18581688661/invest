@extends('layouts.default')
@section('title', '用户注册')
@section('content')
<div class="container">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h5>用户注册</h5>
      </div>
      <div class="panel-body">
        @include('shared.errors')
        <form method="POST" action="{{ route('user.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="username" style="width: 80px;">用户名：</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
          </div>
          <div class="form-group">
            <label for="email" style="width: 80px;">邮箱：</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            <input id="email_btn" class=" btn btn-info" type="button" value="发送邮箱验证码"/>
          </div>
          <div class="form-group">
            <label for="verification_code" style="width: 80px;">验证码：</label>
            <input type="text" name="verification_code" class="form-control" value="{{ old('verification_code') }}" required>
          </div>
          <div class="form-group">
            <label for="password" style="width: 80px;">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation" style="width: 80px;">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
          </div>
          <button type="submit" class="btn btn-primary">注册</button>
        </form>
        <hr>
        <p>已经有账号了？<a href="{{ route('login') }}">现在登录！</a></p>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <img src="/images/invest.jpg" height="420" width="620" />
  </div>
</div>
@stop
@section('script')
<script type="text/javascript">
var sleep = 60, interval = null;
window.onload = function ()
{
  var btn = document.getElementById ('email_btn');
  btn.onclick = function ()
  {
    if (!interval)
    {
      $.ajax({  
           　 type: "get", //用GET方式传输     　　  
           　 url: "{{ route('email') }}", 
           data: {email:$("input[name='email']").val()},
           success:toastr.success('验证码发送成功！'),
         }); 
      this.style.backgroundColor = 'rgb(243, 182, 182)';
      this.disabled = "disabled";
      this.style.cursor = "wait";
      this.value = "重新发送 (" + sleep-- + ")";
      
      interval = setInterval (function ()
      {
        if (sleep == 0)
        {
          if (!!interval)
          {
            clearInterval (interval);
            interval = null;
            sleep = 60;
            btn.style.cursor = "pointer";
            btn.removeAttribute ('disabled');
            btn.value = "发送邮箱验证码";
            btn.style.backgroundColor = '';
          }
          return false;
        }
        btn.value = "重新发送 (" + sleep-- + ")";
      }, 1000);
    }
  }
}
</script>
@stop