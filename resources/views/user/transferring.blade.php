@extends('layouts.default')
@section('title','转让中心')
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
            <li style="text-align: center"><a href="{{ route('project_invested') }}" style="font-size: 16px">所有已投项目</a></li>
            <li style="text-align: center"><a href="{{ route('project_backing') }}" style="font-size: 16px">回款中项目</a></li>
            <li style="text-align: center"><a href="{{ route('project_backed') }}" style="font-size: 16px">已回款项目</a></li>
            <li style="text-align: center"><a href="{{ route('project_transferring') }}" style="font-size: 16px">转让中项目</a></li>
            <li style="text-align: center"><a href="{{ route('project_transferred') }}" style="font-size: 16px">已转让项目</a></li>
            <li style="text-align: center"><a href="{{ route('transferring') }}" style="font-size: 16px">转让中心</a></li>
                <li style="text-align: center"><a href="{{ route('current_deposit') }}" style="font-size: 16px">活期存款</a></li>
            </ul>
    </div>
    <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
    <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
    <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
</ul>
</div>
<div class="container col-lg-10">
    <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp转让列表</h4>
    <div class="container col-lg-12" style="margin-top: 20px;">
        @if (count($invests))
        <table class="table">
            <tr>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">项目名称</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">年化收益</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">转让金额</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">转让发布时间</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">项目结束时间</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">操作</td>
            </tr>
            @foreach ($invests as $invest)
            <tr>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->project_name }}</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->get_project($invest->project_id)->rate }}%</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $invest->invest_amount }}</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->transfer_time }}</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $invest->get_project($invest->project_id)->project_stop_time }}</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($invest->invest_state == 0)回款中@elseif($invest->invest_state == 1)已回款@elseif($invest->invest_state == 2)转让中@else已转让@endif</td>
                <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">
                    <a href="javascript:;" class="md-trigger" data-modal="modal-{{ $invest->id }}"><button class="btn button-glow button-rounded  button-primary" style="font-size: 15px;font-weight: 600">购买转让</button></a>
                </td>
            </tr>
            <div class="md-modal md-effect-17" id="modal-{{ $invest->id }}">
            <div class="md-content">
              <h3>购买转让</h3>
              <div>
                @if(Auth::user()->get()->real_name)
                @if(Auth::user()->get()->id == $invest->user_id)
                <form action="#" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <div style="font-size: 20px;">对不起，不能购买自己的项目转让！</div>
                    </div>
                    <div class="form-group">
                        <button type="button" style="float: " class="md-close btn btn-primary">关闭</button>
                    </div>
                </form>

            @else
            <form action="{{ route('buy_transfer') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <input type="hidden" name="invest_id" value="{{ $invest->id}} ">
                  <div class="form-group">
                    <label for="capital_password" style="width: 160px;">资金密码：</label>
                    <input type="password" class="form-control" name="capital_password" placeholder="请输入资金密码" required>
                </div>
                <div class="form-group">
                    <div>可用余额：¥{{ Auth::user()->get()->balance }}</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">确定购买</button>
                    <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @endif
            @else
            <form action="#" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div style="font-size: 20px;">对不起，您尚未进行实名认证，不能进行投资操作！</div>
                    <div style="font-size: 20px;">前往<a href="/certification">实名认证</a></div>
                </div>
                <div class="form-group">
                    <button type="button" style="float: " class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endforeach
<div class="md-overlay"></div>
</table>
<div class="text-center">{!! $invests->render() !!}</div>
@else
<img src="images/nodata.jpg" style="margin-left: 200px;">
@endif
</div>
</div>
@stop