@extends('layouts.default')
@section('title','实名认证')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse " id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">银行卡</a></li>
            </ul>
        </div>
		<li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp投资管理</a></li>
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
		<li style="text-align: center" class="active"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp实名认证</a></li>
        <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp风险测评</a></li>
        <li style="text-align: center"><a href="#" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户安全</a></li>
	</ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp实名认证</h4>
  @if(Auth::user()->get()->real_name)
  <p style="font-size: 14px;color: #999;margin-top: 20px">您已完成实名认证！</p>
  <h4 style="color: #999;margin-top: 20px;">姓名：{{Auth::user()->get()->real_name}}</h4>
    <h4 style="color: #999;margin-top: 20px;">身份证：{{Auth::user()->get()->ID_card}}</h4>
        <h4 style="color: #999;margin-top: 20px;">认证时间：{{Auth::user()->get()->certification_time}}</h4>
            @else
            <div class="container col-lg-5" style="margin-top: 20px">
                <form method="POST" action="{{ route('certificate') }}">
                @include('shared.errors')
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="real_name">真实姓名：</label>
                    <input type="text" name="real_name" class="form-control" value="{{ old('real_name') }}">
                </div>
                <div class="form-group">
                    <label for="ID_card">身份证：</label>
                    <input type="text" name="ID_card" class="form-control" value="{{ old('ID_card') }}">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            </div>
            @endif
        </div>
@stop