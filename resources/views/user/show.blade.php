@extends('layouts.default')
@section('title','个人中心')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center" class="active"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
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
		<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp账户中心</h4>
		<p style="font-size: 14px;color: #999;margin-top: 20px">欢迎您！@if(Auth::user()->get()->real_name){{Auth::user()->get()->real_name}}@else{{Auth::user()->get()->username}}@endif</p>
        <p style="font-size: 14px;color: #999;margin-top: 20px">上次登录时间：{{Auth::user()->get()->last_login_time}}</p>
		<div class="container col-lg-12"style="margin-top: 10px">
			<div class="container col-lg-10" style="font-size: 18px;margin-left: -29px;color:#666;line-height: 34px;">可用余额：¥{{Auth::user()->get()->balance}}</div>
            <div class="container col-lg-2 pull-right">
                <a href="{{ route('recharge') }}"><button class="btn" style="background: #FFAC2A;color: #FFFFFF;font-weight: 900">充值</button></a>
                <a href="{{ route('withdrawals') }}"><button class="btn btn-success" style="margin-left: 2px;color: #FFFFFF;font-weight: 900">提现</button></a>
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
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥{{Auth::user()->get()->profit}}</p>
            </div>
        </div>
        <div class="container col-lg-12" style="margin-top: 20px;background: #F7F7F9">
            <div class="container col-lg-12">
                <h4 style="border-left: 3px solid #FFAC2A;margin-left: -29px;float: left">&nbsp&nbsp我的交易明细</h4>
                <h4><a href="{{ route('transaction_record') }}" style=";color:#FFAC2A;float: right">查看更多&nbsp></a></h4>
            </div>
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
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($transaction_detail->transaction_type == '投资支出')-@elseif($transaction_detail->transaction_type == '项目回款(本金)')+@elseif($transaction_detail->transaction_type == '项目回款(收益)')+@endif{{ $transaction_detail->amount }}</td>
        			<td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $transaction_detail->remarks }}</td>
        		</tr>
        		@endforeach
        	</table>
            @else
            <p>暂无交易明细！</p>
            @endif
        </div>
	</div>
@stop
@section('script')
<script type="text/javascript">
window.onload = function ()
{
  var btn = document.getElementById ('test');
  btn.onclick = function ()
  {
    $.get("{{ route('message') }}",
        // {'_token': '{{ csrf_token() }}'},
        function(data) {  
            $('body').html(data);  
        });
}
}
//
        <button id="test">
            测试
        </button>
</script>
@stop