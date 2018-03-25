@extends('layouts.default')
@section('title','用户管理')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('mana_show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp平台概览</a></li>
		<li style="text-align: center" class="active"><a href="{{ route('user_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp用户管理</a></li>
		<li style="text-align: center"><a href="{{ route('withdrawals_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp提现管理</a></li>
		<li style="text-align: center"><a href="{{ route('project_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp项目管理</a></li>
		<li style="text-align: center"><a href="{{ route('notice_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp公告管理</a></li>
        <li style="text-align: center"><a href="{{ route('current_manage') }}" style="font-size: 17px"><span class="glyphicon glyphicon-usd"></span>&nbsp&nbsp活期存款</a></li>
    </ul>
</div>
<div class="container col-lg-10">
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp用户管理</h4>
    <form action="{{ route('user_search') }}" method="POST">
        {{ csrf_field() }}
        <div class="input-group col-lg-3" style="margin-top:0px positon:relative">
          <input type="text" class="form-control" name="keyword" placeholder="请输入用户名"/>  
          <span class="input-group-btn">
             <button type="submit" class="btn btn-success btn-search">查找</button>
         </span>  
     </div> 
 </form>
    <!-- <hr> -->
    @if (count($users))
            <table class="table table-bordered" style="margin-top: 10px;">
                <tr>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">用户ID</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">用户名</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">邮箱</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">真实姓名</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">身份证号</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">手机号</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">紧急联系人</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">最近登录时间</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">注册时间</td>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->id }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->username }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->email }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->real_name }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->ID_card }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->mobile }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->contact }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->this_login_time }}</td>
                    <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $user->signup_time }}</td>
                </tr>
                @endforeach
                
            </table>
            <div class="text-center">{!! $users->render() !!}</div>
            @else
            <p style="margin-top: 10px;font-size: 18px;color: #999;">
            暂无结果！
            </p>
            @endif
	<div class="md-modal md-effect-17" id="modal-1">
    <div class="md-content">
      <h3>新增投资项目</h3>
      <div>
        <form action="{{ route('project_add') }}" method="POST" class="form-horizontal">
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