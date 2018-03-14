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
	<h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp提现管理</h4>
	<button id="all" class="btn btn-success">查看所有提现申请</button>
  <hr>
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
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666;">操作</td>
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
              <td class="text-center" style="vertical-align: middle;font-size: 18px;color: #666">
                  <a href="javascript:;" class="md-trigger" data-modal="modal-{{ $withdrawal->id }}"><button class="btn btn-primary">处理</button></a>
              </td>
            </tr>
            <div class="md-modal md-effect-17" id="modal-{{ $withdrawal->id }}">
    <div class="md-content">
      <h3>提现处理</h3>
      <div>
        <form action="{{ route('withdrawals_handle') }}" method="POST" class="form-horizontal">
          @include('shared.messages')
            {{ csrf_field() }}
            <div class="form-group">
              <label for="pass" style="width: 120px;">处理意见：</label>
              <!-- <div class="radio"> -->
                <label>
                  <input type="radio" name="pass" value="1" checked>
                  通过
                </label>
                <label>
                  <input type="radio" name="pass" value="2">
                  不通过
                </label>
              <!-- </div> -->
            </div>
            <div class="form-group">
                <label for="remarks" style="width: 120px;">理由(备注)：</label>
                <input type="text" class="form-control" name="remarks" placeholder="请输入备注" required>
            </div>
            <input type="hidden" name="withdrawals_id" value="{{ $withdrawal->id }}">
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">确定</button>
                <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
            </div>
        </form>
    </div>
</div>
</div>
            @endforeach
          </table>
          <div class="text-center">{!! $withdrawals->render() !!}</div>
            @else
            <p>暂无待处理的提现申请！</p>
            @endif
<div class="md-overlay"></div>
</div>
@stop
@section('script')
<script type="text/javascript">
window.onload = function ()
{
  var btn = document.getElementById ('all');
  btn.onclick = function ()
  {
    $.get("{{ route('all_withdrawals') }}",
        // {'_token': '{{ csrf_token() }}'},
        function(data) {  
            $('body').html(data);
        });
}
}
</script>
@stop