@extends('layouts.default')
@section('title','个人中心')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center" class="active"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户中心</a></li>
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
		<li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp实名认证</a></li>
        <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp风险测评</a></li>
        <li style="text-align: center"><a href="#" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户安全</a></li>
	</ul>
</div>
	<div class="container col-lg-10">
		<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp账户中心</h4>
		<p style="font-size: 14px;color: #999;margin-top: 20px">欢迎您！@if(Auth::user()->get()->real_name){{Auth::user()->get()->real_name}}@else{{Auth::user()->get()->username}}@endif</p>
        <p style="font-size: 14px;color: #999;margin-top: 20px">上次登录时间：{{Auth::user()->get()->last_login_time}}</p>
		<div class="container col-lg-12"style="margin-top: 10px">
			<div class="container col-lg-10" style="font-size: 18px;margin-left: -29px;color:#666;line-height: 34px;">可用余额：¥{{Auth::user()->get()->balance}}</div>
            <div class="container col-lg-2 pull-right">
                <button class="btn" style="background: #FFAC2A;"><a href="#" style="color: #FFFFFF;font-weight: 900">充值</a></button>
                <button class="btn btn-success" style="margin-left: 2px"><a href="#" style="color: #FFFFFF;font-weight: 900">提现</a></button>
            </div>
		</div>
        <div class="col-lg-12">
            <hr>
        </div>
		<div class="container col-lg-12" style="background: #F7F7F9">
            <div class="col-lg-3" style="float: left;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">资产总额</p>
                <p style="font-size: 18px;color: #FFAC2A;text-align: center;margin-top: 12px">¥100000</p>
            </div>
            <div class="col-lg-3" style="float: left;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">在投资金</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥800</p>
            </div>
            <div class="col-lg-3" style="float: left;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">冻结资金</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥200</p>
            </div>
            <div class="col-lg-3" style="float: left;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">累计收益</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥{{Auth::user()->get()->balance}}</p>
            </div>
        </div>
        <div class="container col-lg-12" style="margin-top: 20px;background: #F7F7F9">
            <div class="container col-lg-12">
                <h4 style="border-left: 3px solid #FFAC2A;margin-left: -29px;float: left">&nbsp&nbsp我的交易明细</h4>
                <h4><a href="#" style=";color:#FFAC2A;float: right">查看更多&nbsp></a></h4>
            </div>
        	<table class="table table-striped">
        		<tr>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">时间</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">交易类型</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">金额</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">备注</td>
        		</tr>
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">2017年12月17日17:57:01</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">支付宝充值</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥1000</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">备注</td>
        		</tr>
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">2017年12月17日17:45:11</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">微信充值</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥3000</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">备注</td>
        		</tr>
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">2017年12月17日17:34:54</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">网银充值</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥4400</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">备注</td>
        		</tr>
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">2017年12月17日17:21:23</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">支付宝充值</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥10</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">备注</td>
        		</tr>
        	</table>
        </div>
	</div>
@stop