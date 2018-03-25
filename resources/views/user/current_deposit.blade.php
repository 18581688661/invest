@extends('layouts.default')
@section('title','活期存款')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
  <ul class="nav nav-pills nav-stacked">
    <li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
    <li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
    <li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
    <div class="collapse" id="collapse1">
      <ul class="nav">
        <li style="text-align: center"><a href="{{ route('transaction_record') }}" style="font-size: 16px">交易记录</a></li>
        <li style="text-align: center"><a href="{{ route('recharge') }}" style="font-size: 16px;">充值</a></li>
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
                <li style="text-align: center"><a href="{{ route('current_deposit') }}" style="font-size: 16px;color: #FFAC2A;font-weight: bold;">活期存款</a></li>
            </ul>
    </div>
    <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
    <li style="text-align: center"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
    <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
  </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp活期存款</h4>
  <div style="margin-top: 20px;">
    <p style="float: left;font-size: 30px;line-height: 49px;font-weight: 800">当前活期存款年化收益率：</p>
    <button class="btn" style="background-color: #FF7680;font-size: 25px;color:white">{{ $website_info->year_profit }}%</button>
  </div>
  <div style="margin-top: 20px;">
    <p style="float: left;font-size: 30px;line-height: 49px;font-weight: 800">您当前的活期存款金额：</p>
    <button class="btn" style="background-color: #B9E563;font-size: 25px;color:white">¥{{ $current_amount }}元</button>
  </div>
  <div style="margin-top: 20px;">
    <a href="javascript:;" class="md-trigger" data-modal="modal-1">
      <button class="btn" style="background-color: #4CB0F9;font-size: 18px;color:white">存款</button>
    </a>
    <div class="md-modal md-effect-17" id="modal-1">
      <div class="md-content">
        <h3>活期存款</h3>
        <div>
          <form action="{{ route('deposit') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                    <label for="invest_amount" style="width: 100px;">存款金额：</label>
                    <input type="number" min="1" class="form-control" name="invest_amount" placeholder="请输入存款金额" required>
                </div>

            <div class="form-group">
              <label for="capital_password" style="width: 100px;">资金密码：</label>
              <input type="password" class="form-control" name="capital_password" placeholder="请输入资金密码" required>
            </div>
            <div class="form-group">
                    <div>可用余额：¥{{ Auth::user()->get()->balance }}</div>
                </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success form-control">存入</button>
              <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<div class="md-overlay"></div>
  </div>
  @if (count($currents))
          <table class="table" style="margin-top: 20px;">
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">存款金额</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">存款时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">取款时间</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">当前收益</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">状态</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">操作</td>
            </tr>
            @foreach ($currents as $current)
            <tr>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">¥{{ $current->invest_amount }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">{{ $current->invest_start_time }}</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($current->invest_stop_time){{ $current->invest_stop_time }}@else未取款@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($current->profit)¥{{ $current->profit }}@else¥{{ $current->get_profit($current->id) }}@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">@if($current->state == 0)存款中@else已赎回@endif</td>
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">
                @if($current->state == 0)
                <a href="javascript:;" class="md-trigger" data-modal="modal-{{ $current->id }}">
                  <button class="btn btn-primary" style="">赎回</button>
                </a>
                @else

                @endif
              </td>
            </tr>
            <div class="md-modal md-effect-17" id="modal-{{ $current->id }}">
      <div class="md-content">
        <h3>活期存款赎回</h3>
        <div>
          <form action="{{ route('current_redeem') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                    <div style="font-size: 20px;">确定赎回?</div>
                </div>
              <input type="hidden" name="current_id" value="{{ $current->id }}">
              <input type="hidden" name="profit" value="{{ $current->get_profit($current->id) }}">
            <div class="form-group">
              <label for="capital_password" style="width: 100px;">资金密码：</label>
              <input type="password" class="form-control" name="capital_password" placeholder="请输入资金密码" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success form-control">赎回</button>
              <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
          </form>
        </div>
      </div>
    </div>
            @endforeach
            <div class="md-overlay"></div>
          </table>
            <div class="text-center">{!! $currents->render() !!}</div>
             @else
            <p>暂无存款记录！</p>
            @endif
</div>
@stop