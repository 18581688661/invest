@extends('layouts.default')
@section('content')
<!-- 首页轮播图 -->
<div class="carousel slide" data-ride="carousel" id="slide">
    <ul class="carousel-indicators">
        <li data-target="#slide" data-slide-to="0" class="active"></li>
        <li data-target="#slide" data-slide-to="1"></li>
        <li data-target="#slide" data-slide-to="2"></li>
        <li data-target="#slide" data-slide-to="3"></li>
        <li data-target="#slide" data-slide-to="4"></li>
        <li data-target="#slide" data-slide-to="5"></li>
        <li data-target="#slide" data-slide-to="6"></li>
        <li data-target="#slide" data-slide-to="7"></li>
        <li data-target="#slide" data-slide-to="8"></li>
        <li data-target="#slide" data-slide-to="9"></li>
        <li data-target="#slide" data-slide-to="10"></li>
        <li data-target="#slide" data-slide-to="11"></li>
    </ul>
    <div class="carousel-inner">
        <div class="item active">
            <img src="images/cd1.jpg" style="width: 100%;height: 500px" alt="...">
        </div>
        <div class="item">
            <img src="images/cd2.jpg" style="width: 100%;height: 500px" alt="...">
        </div>
        <div class="item">
            <img src="images/cd3.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd4.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd5.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd6.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd7.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd8.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd9.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd10.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd11.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
        <div class="item">
            <img src="images/cd12.jpg" style="width: 100%;height: 500px"  alt="...">
        </div>
    </div>
</div>

<!-- 项目列表 -->
<div class="container col-lg-9">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 20px;text-align: center">项目列表</h3>
        </div>
        @if (count($projects))
        @foreach ($projects as $project)
        <div style="background: #F7F7F9;height: 280px;border-bottom: 1px dashed">
            <div>
                <div style="float: left;font-size: 25px;color: #777;margin-top: 14px;margin-left: 66px">{{$project->project_name}}</div>
                @if($project->project_state == 0)
                <div><button class="btn button-glow button-rounded  button-primary" style="margin-left: 30px;margin-top: 14px;font-size: 15px;font-weight: 600">未开始</button></div>
                @elseif($project->project_state == 1)
                <div><a href="javascript:;" class="md-trigger" data-modal="modal-{{ $project->id }}"><button class="btn button-glow button-rounded  button-primary" style="margin-left: 30px;margin-top: 14px;font-size: 15px;font-weight: 600">投资</button></a></div>
                @elseif($project->project_state == 2)
                <div><button class="btn button-glow button-rounded  button-primary" style="margin-left: 30px;margin-top: 14px;font-size: 15px;font-weight: 600">回款中</button></div>
                @else
                <div><button class="btn button-glow button-rounded  button-primary" style="margin-left: 30px;margin-top: 14px;font-size: 15px;font-weight: 600">已回款</button></div>
                @endif
                
            </div>
            <div>
                <div style="font-size: 16px;color: #777;margin-top: 10px;margin-left: 66px">项目开始时间：{{$project->project_start_time}}</div>
            </div>
            <div>
                <div style="font-size: 16px;color: #777;margin-top: 10px;margin-left: 66px">项目结束时间：{{$project->project_stop_time}}</div>
            </div>
            <div>
                <div style="font-size: 16px;color: #777;margin-top: 10px;margin-left: 66px">项目介绍：{{$project->project_intro}}</div>
            </div>
            <div>
                <div style="font-size: 16px;color: #777;margin-top: 10px;margin-left: 66px">投资人数：{{$project->invest_user_amount}}人</div>
            </div>
            <div>
                <div style="float: left;width: 186px">
                    <p style="font-size: 20px;color: #666;text-align: center;margin-left: 30px;margin-top: 15px">年化收益</p>
                    <p style="font-size: 30px;color: #F72222;text-align: center;margin-left: 30px;margin-top: 12px">{{$project->rate}}%</p>
                </div>
                <div style="float: left;width: 186px">
                    <p style="font-size: 20px;color: #666;text-align: center;margin-top: 15px">项目期限</p>
                    <p style="font-size: 30px;text-align: center;margin-top: 12px">{{$project->project_time}}天</p>
                </div>
                <div style="float: left;width: 186px">
                    <p style="font-size: 20px;color: #666;text-align: center;margin-top: 15px">项目总额</p>
                    <p style="font-size: 30px;text-align: center;margin-top: 12px">¥{{$project->project_amount}}</p>
                </div>
                <div style="float: left;width: 186px">
                    <p style="font-size: 20px;color: #666;text-align: center;margin-top: 15px">已投金额</p>
                    <p style="font-size: 30px;text-align: center;margin-top: 12px">¥{{$project->amount_invested}}</p>
                </div>
                <div style="float: left;width: 186px">
                    <p style="font-size: 20px;color: #666;text-align: center;margin-top: 15px">剩余可投金额</p>
                    <p style="font-size: 30px;text-align: center;margin-top: 12px">¥{{$project->amount_wait}}</p>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-17" id="modal-{{ $project->id }}">
            <div class="md-content">
              <h3>项目投资</h3>
              <div>
                @if (Auth::user()->check())
                @if(Auth::user()->get()->real_name)
                <form action="{{ route('invest') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="invest_amount" style="width: 160px;">投资金额(¥100起投)：</label>
                    <input type="number" min="100" class="form-control" name="invest_amount" placeholder="请输入投资金额" required>
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id}} ">
                <div class="form-group">
                    <label for="capital_password" style="width: 160px;">资金密码：</label>
                    <input type="password" class="form-control" name="capital_password" placeholder="请输入资金密码" required>
                </div>
                <div class="form-group">
                    <div>最大可投金额：¥{{ $project->amount_wait }}</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">确定</button>
                    <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @else
            <form action="{{ route('invest') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div style="font-size: 20px;">对不起，您尚未进行实名认证，不能进行投资操作！</div>
                    <div style="font-size: 20px;">前往<a href="/certification">实名认证</a></div>
                </div>
                <div class="form-group">
                    <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @endif
            @elseif (Auth::manager()->check())
            <form action="#" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div style="font-size: 20px;">对不起，管理员不能进行投资操作！</div>
                </div>
                <div class="form-group">
                    <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @else
            <form action="#" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <div style="font-size: 20px;">对不起，请登录后再进行此操作！</div>
                    <div style="font-size: 20px;">前往<a href="/login">登录</a></div>
                </div>
                <div class="form-group">
                    <button type="button" style="float: right" class="md-close btn btn-primary">关闭</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

@endforeach
<div class="md-overlay"></div>
@endif
</div>

</div>
<!-- 平台注册人数和投资金额 -->
<div class="container col-lg-3">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 20px;text-align: center">平台数据</h3>
        </div>
        <div style="background: #F7F7F9;height: 100%">
            <p style="text-align: center;font-size: 20px;color: #777;">平台已成功运行</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">{{$work_days}}天</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台总注册人数</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">{{$signup_num}}人</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台今日注册人数</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">{{$today_signup_num}}人</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台累计投资金额</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">¥{{ $website_info->total_investment }}</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台今日投资金额</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">¥</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">累计为投资人赚取收益</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">¥{{ $website_info->user_profit }}</p>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
$(function () {
    $("#slide").carousel({
        interval:2500
    })
})
</script>
@stop