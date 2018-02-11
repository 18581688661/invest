@extends('layouts.default')
@section('title','银行卡管理')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse in" id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="{{ route('withdrawals') }}" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px;color: #FFAC2A;font-weight: bold;">银行卡</a></li>
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
        <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
	</ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp银行卡管理</h4>
  @if(Auth::user()->get()->bank_card)
  <p style="font-size: 14px;color: #999;margin-top: 20px">您已绑定银行卡！
    <a href="javascript:;" class="md-trigger" data-modal="modal-1"><button class="btn btn-primary">解绑</button></a></p>
    <h4 style="color: #999;margin-top: 20px;">卡主姓名：{{Auth::user()->get()->real_name}}</h4>
    <h4 style="color: #999;margin-top: 20px;">银行名称：{{Auth::user()->get()->bank_name}}</h4>
    <h4 style="color: #999;margin-top: 20px;">开户行：{{Auth::user()->get()->bank_address}}</h4>
    <h4 style="color: #999;margin-top: 20px;">银行卡号：{{Auth::user()->get()->bank_card}}</h4>
    @else
    <div class="container col-lg-6" style="margin-top: 20px">
        <form method="POST" action="{{ route('bank_binding') }}">
            <!-- @include('shared.errors') -->
            @include('shared.messages')
            {{ csrf_field() }}
            <p style="color: #999;font-size: 16px;">请正确填写银行卡信息，填写有误会影响资金到账！</p>
            <div class="form-group">
                <label for="bank_name" style="width: 80px;">银行名称：</label>
                <select style="width: 177px;" name="bank_name" class="form-control">
                  <option value="中国银行">中国银行</option>
                  <option value="中信银行">中信银行</option>
                  <option value="交通银行">交通银行</option>
                  <option value="华夏银行">华夏银行</option>
                  <option value="招商银行">招商银行</option>
                  <option value="兴业银行">兴业银行</option>
                  <option value="广发银行">广发银行</option>
                  <option value="平安银行">平安银行</option>
                  <option value="中国工商银行">中国工商银行</option>
                  <option value="中国建设银行">中国建设银行</option>
                  <option value="中国农业银行">中国农业银行</option>
                  <option value="中国光大银行">中国光大银行</option>
                  <option value="中国民生银行">中国民生银行</option>
                  <option value="上海浦东发展银行">上海浦东发展银行</option>
                  <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
              </select>
          </div>
            <div class="form-group">
                <label for="bank_address" style="width: 80px;">开户行：</label>
                <input type="text" name="bank_address" class="form-control" value="{{ old('bank_address') }}" required>
            </div>
            <div class="form-group">
                <label for="bank_card" style="width: 80px;">银行卡号：</label>
                <input type="text" name="bank_card" class="form-control" value="{{ old('bank_card') }}" required>
            </div>
            <button type="submit" class="btn btn-success">添加</button>
        </form>
    </div>
    @endif
</div>
<div class="md-modal md-effect-17" id="modal-1">
    <div class="md-content">
      <h3>解绑银行卡</h3>
      <div>
        <form action="{{ route('bank_unbinding') }}" method="POST" class="form-horizontal">
          @include('shared.messages')
            {{ csrf_field() }}
            <p style="font-size: 20px;">确定解绑此银行卡吗？</p>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">确定</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-overlay"></div>
@stop