@extends('layouts.default')
@section('title','账户安全')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
    <ul class="nav nav-pills nav-stacked">
        <li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
        <li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
        <li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse " id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="{{ route('withdrawals') }}" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">银行卡</a></li>
            </ul>
        </div>
        <li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp投资管理</a></li>
        <div class="collapse " id="collapse2">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">所有已投项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">回款中项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">已回款项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">转让中项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">已转让项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">零活宝</a></li>
            </ul>
        </div>
        <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
        <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
        <li style="text-align: center" class="active"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
    </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp账户安全</h4>
  <h4 style="margin-top: 20px;">您的账户安全级别：<span style="color:red;">{{ $security_level }}</span></h4>
  <hr>
  <h4 style="">资料</h4>
  <table class="table table-bordered">
    <tr>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">手机号码</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">手机号是您在平台重要的身份凭证</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->mobile){{Auth::user()->get()->mobile}}@else未绑定@endif</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->mobile)已绑定手机号@else
            <a href="javascript:;" class="md-trigger" data-modal="modal-1"><button class="btn">绑定手机号</button></a>
            @endif</td>
    </tr>
    <tr>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">证件信息</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">保障账户安全，只有完成实名认证才能投资和资金交易</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->ID_card){{Auth::user()->get()->ID_card}}@else未认证@endif</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->ID_card)已认证@else<a href="{{ route('certification') }}">去认证</a>@endif</td>
    </tr>
    <tr>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">紧急联系人</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">紧急联系人是在紧急情况下能够被联系到的与当事人相关的人</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->contact){{Auth::user()->get()->contact}}@else未设置@endif</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">@if(Auth::user()->get()->contact)
            <a href="javascript:;" class="md-trigger" data-modal="modal-2"><button class="btn">更换紧急联系人</button></a>
            @else
            <a href="javascript:;" class="md-trigger" data-modal="modal-3"><button class="btn">设置紧急联系人</button></a>
            @endif</td>
    </tr>
    <tr>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">登录密码</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">上次登录时间：{{Auth::user()->get()->last_login_time}}</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">已设置</td>
        <td class="text-center col-lg-3" style="vertical-align: middle;font-size: 16px;color: #666;">
            <a href="javascript:;" class="md-trigger" data-modal="modal-4"><button class="btn">修改登录密码</button></a>
        </td>
    </tr>
</table>

<div class="md-modal md-effect-17" id="modal-1">
    <div class="md-content">
      <h3>绑定手机号</h3>
      <div>
        <form action="{{ route('mobile_binding') }}" method="POST" class="form-horizontal">
          @include('shared.messages')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="mobile" style="width: 80px;">手机号：</label>
                <input type="tel" class="form-control" name="mobile" placeholder="请输入手机号" required>
                <input id="sms_btn" class="btn btn-info" type="button" value="发送手机验证码"/>
            </div>
            <div class="form-group">
                <label for="verification_code" style="width: 80px;">验证码：</label>
                <input type="text" class="form-control" name="verification_code" placeholder="请输入验证码" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">提交</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-modal md-effect-17" id="modal-2">
    <div class="md-content">
      <h3>更换紧急联系人</h3>
      <div>
        <form action="{{ route('contact_binding') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="contact" style="width: 120px;">联系人手机号：</label>
                <input type="tel" class="form-control" name="contact" placeholder="请输入联系人手机号" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">提交</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-modal md-effect-17" id="modal-3">
    <div class="md-content">
      <h3>设置紧急联系人</h3>
      <div>
        <form action="{{ route('contact_binding') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="contact" style="width: 120px;">联系人手机号：</label>
                <input type="tel" class="form-control" name="contact" placeholder="请输入联系人手机号" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">提交</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-modal md-effect-17" id="modal-4">
    <div class="md-content">
      <h3>修改登录密码</h3>
      <div>
        <form action="{{ route('change_pwd') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="old_password" style="width: 100px;">原密码：</label>
                <input type="text" class="form-control" name="old_password" placeholder="请输入原密码" required>
            </div>
             <div class="form-group">
                <label for="new_password" style="width: 100px;">新密码：</label>
                <input type="text" class="form-control" name="new_password" placeholder="请输入新密码" required>
            </div> <div class="form-group">
                <label for="new_password_confirmation" style="width: 100px;">确认新密码：</label>
                <input type="text" class="form-control" name="new_password_confirmation" placeholder="请再次输入新密码" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">提交</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-overlay"></div>

</div>
@stop
@section('script')
<script type="text/javascript">
    var sleep = 60, interval = null;
    window.onload = function ()
    {
        var btn = document.getElementById ('sms_btn');
        btn.onclick = function ()
        {
            if (!interval)
            {
              $.ajax({  
           　 type: "get", //用GET方式传输     　　  
           　 url: "{{ route('sms') }}", 
              data: {mobile:$("input[name='mobile']").val()},
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
                            btn.value = "发送手机验证码";
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