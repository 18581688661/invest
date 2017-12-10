@extends('layouts.default')
@section('title', '找回密码')
@section('content')
<div class="container">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">重置密码</div>
      <div class="panel-body">
        @include('shared.errors')
        <form method="POST" action="{{ route('password.reset') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="email">注册邮箱：</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            <input id="email_btn" class=" btn btn-info" type="button" value="发送邮箱验证码"/>
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
           　 type: "get", //用POST方式传输     　　  
           　 url: "{{ route('email') }}", 
           data: {email:$("input[name='email']").val()},
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