@extends('layouts.default')
@section('title','交易记录')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse in" id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="{{ route('transaction_record') }}" style="font-size: 16px;color: #FFAC2A;font-weight: bold;">交易记录</a></li>
                <li style="text-align: center"><a href="{{ route('recharge') }}" style="font-size: 16px">充值</a></li>
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
		<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp交易明细</h4>
        <div class="container col-lg-12" style="margin-top: 20px;">
            @if (count($transaction_details))
        	<table class="table">
        		<tr>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">时间</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">交易类型</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">金额(元)</td>
        			<td class="text-center col-lg-3" style="vertical-align: middle;font-size: 18px;color: #666;">备注</td>
        		</tr>
                @foreach ($transaction_details as $transaction_detail)
        		<tr>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $transaction_detail->transaction_time }}</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $transaction_detail->transaction_type }}</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($transaction_detail->transaction_type == '投资支出')-@elseif($transaction_detail->transaction_type == '项目转让(本金)')+@elseif($transaction_detail->transaction_type == '项目转让(收益)')+@elseif($transaction_detail->transaction_type == '购买转让')-@elseif($transaction_detail->transaction_type == '项目回款(本金)')+@elseif($transaction_detail->transaction_type == '项目回款(收益)')+@elseif($transaction_detail->transaction_type == '提现成功')-@endif{{ $transaction_detail->amount }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $transaction_detail->remarks }}</td>
                </tr>
        		@endforeach
        	</table>
            <div class="text-center">{!! $transaction_details->render() !!}</div>
             @else
            <img src="images/nodata.jpg" style="margin-left: 200px;">
            @endif
        </div>
	</div>
@stop