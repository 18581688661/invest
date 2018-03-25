@extends('layouts.default')
@section('title','平台概览')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center" class="active"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="{{ route('user_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
		<li style="text-align: center"><a href="{{ route('current_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-usd"></span>&nbsp&nbsp活期存款</a></li>
	</ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp平台概览</h4>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #F6F6F6;margin-top: 20px;">平台运营天数：{{ $work_days }}天</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #4CB0F9;margin-left: 10px;margin-top: 20px;">平台用户总数：{{ $signup_num }}人</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #B9E563;margin-top: 20px;">平台今日注册用户数：{{ $today_signup_num }}人</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #FEC04E;margin-left: 10px;margin-top: 20px;">平台累计总投资额：¥{{ $website_info->total_investment }}元</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #FF7680;margin-top: 20px;">平台今日投资额：¥{{ $today_invest }}元</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #A49EF0;margin-left: 10px;margin-top: 20px;">平台累计为用户赚取收益：¥{{ $website_info->user_profit }}元</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #2DA9FF;margin-top: 20px;">平台发布的项目总数：{{ $project_num }}个</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #F47F59;margin-left: 10px;margin-top: 20px;">平台发布的项目总金额：¥{{ $project_all_amount }}元</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #FF9739;margin-top: 20px;">回款中的项目总金额：¥{{ $backing_amount }}元</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #FF749D;margin-left: 10px;margin-top: 20px;">转让中项目总金额：¥{{ $transferring_amount }}元</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #CA76FD;margin-top: 20px;">当前活期存款总金额：¥{{ $website_info->current_amount }}元</div>
		<div class="col-lg-6" style="width: 500px;height: 50px;font-size: 20px;line-height: 50px;background-color: #12A0FF;margin-left: 10px;margin-top: 20px;">累计为用户赚取活期存款收益：¥{{ $website_info->current_profit }}元</div>
	</div>
</div>
@stop