@extends('layouts.default')
@section('title','公告管理')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center"><a href="{{ route('user_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center" class="active"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
	</ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp公告管理</h4>
	<a href="javascript:;" class="md-trigger" data-modal="modal-1"><button class="btn btn-success">新增公告</button></a>
    <hr>
    @if (count($notices))
    @foreach ($notices as $notice)
        <div class="panel panel-info text-center" style="">
          <div class="panel-heading">
            <h5 style="font-size: 20px;">{{ $notice->title }}(发布时间：{{ $notice->time }})</h5>

        </div>
        <div class="panel-body">
            <p style="font-size: 18px;color: #666">{{ $notice->text }}</p>
            <hr>
            <p style="font-size: 18px;color: #666" align="right">【清风理财】运营团队</p>
        </div>
    </div>    
    @endforeach
    <div class="text-center">{!! $notices->render() !!}</div>
    @else
    暂无公告！
    @endif
	<div class="md-modal md-effect-17" id="modal-1">
    <div class="md-content">
      <h3>新增公告</h3>
      <div>
        <form action="{{ route('notice_add') }}" method="POST" class="form-horizontal">
          @include('shared.messages')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title" style="width: 120px;">公告标题：</label>
                <input type="text" class="form-control" name="title" placeholder="请输入公告标题" required>
            </div>
            <div class="form-group">
                <label for="text" style="width: 120px;">公告内容：</label>
                <textarea rows='3' cols='50' class="form-control" name="text" placeholder="请输入公告内容" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">发布</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="md-overlay"></div>
</div>
@stop