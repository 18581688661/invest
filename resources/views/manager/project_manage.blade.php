@extends('layouts.default')
@section('title','投资项目管理')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center" class="active"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="#" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp投资项目管理</a></li>
		<li style="text-align: center"><a href="" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
	</ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp投资项目管理</h4>
	<a href="javascript:;" class="md-trigger" data-modal="modal-1"><button class="btn btn-primary">新增投资项目</button></a>
	<div class="md-modal md-effect-17" id="modal-1">
    <div class="md-content">
      <h3>新增投资项目</h3>
      <div>
        <form action="{{ route('mobile_binding') }}" method="POST" class="form-horizontal">
          @include('shared.messages')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="project_name" style="width: 120px;">项目名称：</label>
                <input type="text" class="form-control" name="project_name" placeholder="请输入项目名称" required>
            </div>
            <div class="form-group">
                <label for="project_amount" style="width: 120px;">项目金额(元)：</label>
                <input type="number" min="1" class="form-control" name="project_amount" placeholder="请输入项目金额" required>
            </div>
            <div class="form-group">
                <label for="rate" style="width: 120px;">年化收益(%)：</label>
                <input type="text" class="form-control" name="rate" placeholder="请输入年化收益率" required>
            </div>
            <div class="form-group">
                <label for="project_start_time" style="width: 120px;">项目开始时间：</label>
                <input type="datetime-local" class="form-control" name="project_start_time" placeholder="请选择项目开始时间" required>
            </div>
            <div class="form-group">
                <label for="project_time" style="width: 120px;">项目期限(天)：</label>
                <input type="number" min="1" class="form-control" name="project_time" placeholder="请输入项目期限" required>
            </div>
            <div class="form-group">
                <label for="project_intro" style="width: 120px;">项目简介：</label>
                <input type="text" class="form-control" name="project_intro" placeholder="请输入项目简介" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">提交</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-overlay"></div>
</div>
@stop