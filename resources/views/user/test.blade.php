@extends('layouts.default')
@section('title','个人中心')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
  <ul class="nav nav-pills nav-stacked">
    <li role="presentation" style="text-align: center"><a href="{{ route('show') }}">账户中心</a></li>
    <li role="presentation" style="text-align: center" ><a href="{{ route('message') }}">消息中心</a></li>
    <li role="presentation" style="text-align: center"><a href="#">资金管理</a></li>
    <li role="presentation" style="text-align: center"><a href="#">投资管理</a></li>
    <li role="presentation" style="text-align: center"><a href="#">交易明细</a></li>
    <li role="presentation" style="text-align: center"><a href="#">账户安全</a></li>
  </ul>
</div>
  <div class="container col-lg-10">
    <p style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 30px">&nbsp&nbsp账户中心</p>
    <p style="font-size: 14px;color: #999;margin-top: 20px">欢迎您！{{Auth::user()->get()->username}}</p>
    <div>
      <div style="font-size: 18px;float: left;margin-top: 5px">可用余额：¥<p style="font-size: 18px;float:right">10</p></div>
      <button class="btn" style="background: #FFAC2A;margin-left:820px;"><a href="#" style="color: #FFFFFF;font-weight: 900">充值</a></button>
      <button class="btn btn-success" style="margin-left: 2px"><a href="#" style="color: #FFFFFF;font-weight: 900">提现</a></button>
    </div>
    <hr>
    <div style="background: #F7F7F9">
            <div style="float: left;width: 265px;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">资产总额</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥1000</p>
            </div>
            <div style="float: left;width: 265px;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">在投资金</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥800</p>
            </div>
            <div style="float: left;width: 265px;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">冻结资金</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥200</p>
            </div>
            <div style="float: left;width: 265px;background: #F7F7F9">
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 24px">累计收益</p>
                <p style="font-size: 18px;color: #666;text-align: center;margin-top: 12px">¥200</p>
            </div>
        </div>
        <div>
          <p style="font-size: 20px;margin-top: 140px">我的交易明细</p>
          <table class="table table-striped" style="width: 1060px">
            <tr>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">时间</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">交易类型</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">金额</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">备注</td>
            </tr>
            <tr>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">2017年12月17日17:57:01</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">支付宝充值</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">¥1000</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">备注</td>
            </tr>
            <tr>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">2017年12月17日17:45:11</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">微信充值</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">¥3000</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">备注</td>
            </tr>
            <tr>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">2017年12月17日17:34:54</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">网银充值</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">¥4400</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">备注</td>
            </tr>
            <tr>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">2017年12月17日17:21:23</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">支付宝充值</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">¥10</td>
              <td class="text-center" style="vertical-align: middle;width: 600px;font-size: 18px;color: #666">备注</td>
            </tr>
          </table>
        </div>
  </div>
@stop