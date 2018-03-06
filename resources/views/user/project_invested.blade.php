@extends('layouts.default')
@section('title','所有已投项目')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse " id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="{{ route('transaction_record') }}" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="{{ route('recharge') }}" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="{{ route('withdrawals') }}" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="{{ route('bank_manage') }}" style="font-size: 16px">银行卡</a></li>
            </ul>
        </div>
		<li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp投资管理</a></li>
        <div class="collapse in" id="collapse2">
            <ul class="nav">
                <li style="text-align: center"><a href="{{ route('project_invested') }}" style="font-size: 16px;color: #FFAC2A;font-weight: bold;">所有已投项目</a></li>
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
		<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp所有已投项目</h4>
        <div class="container col-lg-12" style="margin-top: 20px;">
            @if (count($invests))
        	<table class="table">
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">项目名称</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">投资金额</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">投资时间</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">项目结束时间</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">转让时间</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">预期收益</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
        		</tr>
                @foreach ($invests as $invest)
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->project_name }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->invest_amount }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->invest_start_time }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->project_stop_time }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($invest->transfer_time){{ $invest->transfer_time }}@else此项目未转让@endif</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->profit }}</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($invest->invest_state == 0)回款中@elseif($invest->invest_state == 1)已回款@elseif($invest->invest_state == 2)转让中@else已转让@endif</td>
        		</tr>
        		@endforeach
        	</table>
            <div class="text-center">{!! $invests->render() !!}</div>
            @else
            <img src="images/nodata.jpg" style="margin-left: 200px;">
            @endif
        </div>
	</div>
@stop