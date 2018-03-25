@extends('layouts.default')
@section('title','资金充值')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
  <ul class="nav nav-pills nav-stacked">
    <li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
    <li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
    <li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
    <div class="collapse in" id="collapse1">
      <ul class="nav">
        <li style="text-align: center"><a href="{{ route('transaction_record') }}" style="font-size: 16px">交易记录</a></li>
        <li style="text-align: center"><a href="{{ route('recharge') }}" style="font-size: 16px;color: #FFAC2A;font-weight: bold;">充值</a></li>
        <li style="text-align: center"><a href="{{ route('withdrawals') }}" style="font-size: 16px">提现</a></li>
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
                <li style="text-align: center"><a href="{{ route('current_deposit') }}" style="font-size: 16px">活期存款</a></li>
            </ul>
    </div>
    <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
    <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
    <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
  </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp资金充值</h4>
  @if(Auth::user()->get()->real_name)
  <div class="container col-lg-6" style="margin-top: 20px">
    <form method="POST" class="form-inline" action="{{ route('recharge_middle') }}">
        <!-- @include('shared.errors') -->
        @include('shared.messages')
        {{ csrf_field() }}
        <div class="form-group">
            <label for="amount" style="width: 80px;">充值金额：</label>
            <input type="number" name="amount" min="1" max="100000" class="form-control" value="{{ old('amount') }}" required>
            <p style="font-size: 14px;color: #999;margin-top: 20px">请输入1-100,000之间的正整数</p>
            <label for="amount" style="width: 80px;">充值方式：</label>
            <div class="radio">
                <label>
                    <p><input type="radio" name="istype" value="1" checked>
                        <img src="images/alipay.png"></p>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <p><input type="radio" name="istype" value="2">
                            <img src="images/weixinpay.png"></p>
                        </label>
                    </div>
        </div>
        <div>
        <button type="submit" class="btn btn-success">充值</button></div>
    </form>
</div>
<div class="col-lg-12">
      <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp充值记录</h4>
      @if (count($recharges))
          <table class="table">
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">充值金额</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">充值订单号</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">充值渠道</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">时间</td>
            </tr>
                @foreach ($recharges as $recharge)
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $recharge->recharge_amount }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $recharge->orderid }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($recharge->istype==1)支付宝充值@else微信支付@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($recharge->state == 0)充值失败@else充值成功@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $recharge->recharge_time }}</td>
            </tr>
            @endforeach
          </table>
          <div class="text-center">{!! $recharges->render() !!}</div>
            @else
            <p>暂无充值记录！</p>
            @endif
    </div>
@else
<p style="color: #999;font-size: 18px;margin-top: 20px;">您尚未进行实名认证，请先进行<a href="{{ route('certification') }}">实名认证</a></p>
@endif
</div>
@stop