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
            </ul>
    </div>
    <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
    <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
    <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
  </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp资金充值</h4>
  <p style="font-size: 18px;color: #666;margin-top: 20px;">请确认充值信息：</p>
  <div class="" style="margin-top: 20px">
    <form method="POST" action="https://pay.paysapi.com/">
        @include('shared.messages')
        {{ csrf_field() }}
        <div class="form-group">
            <p style="font-size: 18px;color: #666;margin-top: 20px;">充值金额：¥{{ $price }}元</p>
            <p style="font-size: 18px;color: #666;margin-top: 20px;">支付方式：@if($istype==1)<img src="images/alipay.png">@else<img src="images/weixinpay.png">@endif</p>
            <input type="hidden" name="uid" value="{{ $uid }}">
            <input type="hidden" name="price" value="{{ $price }}">
            <input type="hidden" name="istype" value="{{ $istype }}">
            <input type="hidden" name="notify_url" value="{{ $notify_url }}">
            <input type="hidden" name="return_url" value="{{ $return_url }}">
            <input type="hidden" name="orderid" value="{{ $orderid }}">
            <input type="hidden" name="orderuid" value="{{ $orderuid }}">
            <input type="hidden" name="goodsname" value="{{ $goodsname }}">
            <input type="hidden" name="key" value="{{ $key }}">
        </div>
        <button type="submit" class="btn btn-success">前往充值</button>
    </form>
</div>
</div>
@stop