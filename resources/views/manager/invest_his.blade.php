@extends('layouts.default')
@section('title','投资历史记录')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="{{ route('user_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center" class="active"><a href="{{ route('project_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
        <li style="text-align: center"><a href="{{ route('current_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-usd"></span>&nbsp&nbsp活期存款</a></li>
    </ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp投资历史记录</h4>
    <a href="{{ route('project_manage') }}"><button class="btn btn-primary">返回</button></a>
    @if (count($invests))
            <table class="table" style="margin-top: 10px;">
                <tr>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">用户</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">投资金额</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">投资时间</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">备注</td>
                </tr>
                @foreach ($invests as $invest)
                <tr>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->get_username($invest->user_id) }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $invest->invest_amount }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->invest_start_time }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->remarks }}</td>
                </tr>
              @endforeach
            </table>
            <div class="text-center">{!! $invests->render() !!}</div>
            @endif
</div>
@stop