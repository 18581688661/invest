@extends('layouts.default')
@section('title','活期存款')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="{{ route('user_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
		<li style="text-align: center" class="active"><a href="{{ route('current_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-usd"></span>&nbsp&nbsp活期存款</a></li>
	</ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp活期存款</h4>
	<div style="margin-top: 20px;">
		<p style="float: left;font-size: 30px;line-height: 49px;font-weight: 800">当前平台活期存款总金额：</p>
		<button class="btn" style="background-color: #B9E563;font-size: 25px;color:white">¥{{ $website_info->current_amount }}元</button>
	</div>

	<div style="margin-top: 20px;">
		<p style="float: left;font-size: 30px;line-height: 49px;font-weight: 800">当前活期存款年化收益率：</p>
		<button class="btn" style="background-color: #FF7680;font-size: 25px;color:white">{{ $website_info->year_profit }}%</button>
	</div>
	<div style="margin-top: 20px;">
		<a href="javascript:;" class="md-trigger" data-modal="modal-add"><button class="btn btn-success">修改年化收益率</button></a>
	</div>

	<div class="md-modal md-effect-17" id="modal-add">
		<div class="md-content">
			<h3>修改活期存款利率</h3>
			<div>
				<form action="{{ route('current_profit') }}" method="POST" class="form-horizontal">
					@include('shared.messages')
					{{ csrf_field() }}
					<div class="form-group">
						<label for="year_profit" style="width: 120px;">年化收益率(%)：</label>
						<input type="text" class="form-control" name="year_profit" placeholder="请输入年化收益率" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success form-control">确定</button>
						<button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="md-overlay"></div>
</div>
@stop