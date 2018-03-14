@extends('layouts.default')
@section('title','提现管理')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="#" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center" class="active"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
	</ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp所有提现申请</h4>
     @if (count($withdrawals))
          <table class="table">
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">提现用户</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">提现用户ID</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">提现金额</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">提现银行</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">银行卡号</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">申请提现时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">处理时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">备注</td>
            </tr>
                @foreach ($withdrawals as $withdrawal)
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->get_user($withdrawal->user_id)->username }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->user_id }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $withdrawal->withdrawals_amount }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->get_user($withdrawal->user_id)->bank_name }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->get_user($withdrawal->user_id)->bank_card }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->withdrawals_time }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($withdrawal->handle_time){{ $withdrawal->handle_time }}@else未处理@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($withdrawal->state == 0)待处理@elseif($withdrawal->state == 1)提现成功@else提现失败@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $withdrawal->remarks }}</td>
            </tr>
            
            @endforeach
          </table>
          <div class="text-center">{!! $withdrawals->render() !!}</div>
            @else
            <p>暂无待处理的提现申请！</p>
            @endif
<div class="md-overlay"></div>
</div>
@stop