@extends('layouts.default')
@section('title','资金提现')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
  <ul class="nav nav-pills nav-stacked">
    <li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
    <li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
    <li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
    <div class="collapse in" id="collapse1">
      <ul class="nav">
        <li style="text-align: center"><a href="{{ route('transaction_record') }}" style="font-size: 16px">交易记录</a></li>
        <li style="text-align: center"><a href="{{ route('recharge') }}"  style="font-size: 16px">充值</a></li>
        <li style="text-align: center"><a href="{{ route('withdrawals') }}"style="font-size: 16px;color: #FFAC2A;font-weight: bold;">提现</a></li>
        <li style="text-align: center"><a href="{{ route('bank_manage') }}" style="font-size: 16px">银行卡</a></li>
      </ul>
    </div>
    <li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp投资管理</a></li>
    <div class="collapse " id="collapse2">
      <ul class="nav">
                <li style="text-align: center"><a href="{{ route('project_invested') }}" style="font-size: 16px">所有已投项目</a></li>
                <li style="text-align: center"><a href="{{ route('project_backing') }}" style="font-size: 16px">回款中项目</a></li>
                <li style="text-align: center"><a href="{{ route('project_backed') }}" style="font-size: 16px">已回款项目</a></li>
                <li style="text-align: center"><a href="{{ route('project_transferring') }}" style="font-size: 16px">转让中项目</a></li>
                <li style="text-align: center"><a href="{{ route('project_transferred') }}" style="font-size: 16px">已转让项目</a></li>
                <li style="text-align: center"><a href="{{ route('transferring') }}" style="font-size: 16px">转让中心</a></li>
            </ul>
    </div>
    <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
    <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
    <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
  </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp资金提现</h4>
  @if(Auth::user()->get()->real_name)
    @if(Auth::user()->get()->bank_card)
    <div class="container col-lg-6" style="margin-top: 20px">
        <form method="POST" action="{{ route('withdrawals1') }}">
            @include('shared.errors')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="amount" style="width: 90px;">提现金额：</label>
                <input type="number" name="amount" min="1" max="100000" class="form-control" value="{{ old('amount') }}" required>
                <p style="font-size: 14px;color: #999;margin-top: 20px">可用余额：¥{{ Auth::user()->get()->balance }}</p>
            </div>
            <div class="form-group">
                <label for="verification_code" style="width: 90px;">邮箱验证码：</label>
                <input type="text" class="form-control" name="verification_code" placeholder="请输入验证码" required>
                <input type="hidden" name="email" class="form-control" value="{{ Auth::user()->get()->email }}" required>
                <input id="email_btn" class=" btn btn-info" type="button" value="发送验证码"/>
            </div>
            <button type="submit" class="btn btn-success">提现</button>
        </form>
    </div>
    <div class="col-lg-12">
      <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp提现记录</h4>
      @if (count($withdrawals))
          <table class="table">
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">提现金额</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">申请提现时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">处理时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">备注</td>
            </tr>
                @foreach ($withdrawals as $withdrawal)
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $withdrawal->withdrawals_amount }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->withdrawals_time }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($withdrawal->handle_time){{ $withdrawal->handle_time }}@else未处理@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($withdrawal->state == 0)待处理@elseif($withdrawal->state == 1)提现成功@else提现失败@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->remarks }}</td>
            </tr>
            @endforeach
          </table>
          <div class="text-center">{!! $withdrawals->render() !!}</div>
            @else
            <p>暂无提现记录！</p>
            @endif
    </div>
    @else
    <p style="color: #999;font-size: 18px;margin-top: 20px;">您尚未添加提现银行卡信息，请先<a href="{{ route('bank_manage') }}">添加银行卡</a></p>
    @endif
  @else
  <p style="color: #999;font-size: 18px;margin-top: 20px;">您尚未进行实名认证，请先进行<a href="{{ route('certification') }}">实名认证</a></p>
  @endif
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