@extends('layouts.default')
@section('script')
<script>
        $(function () {
            $("#slide").carousel({
                interval:2500
            })
        })
    </script>
@stop
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
                <li data-target="#slide" data-slide-to="12"></li>
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
    <div style="background: #F7F7F9;height: 200px;border-bottom: 1px dashed">
        <div>
            <div style="float: left;font-size: 25px;color: #777;margin-top: 28px;margin-left: 66px">清风4期</div>
            <div><button class="btn btn-danger" style="margin-left: 30px;margin-top: 28px;font-size: 15px;">投资</button></div>
        </div>
        <div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-left: 30px;margin-top: 24px">年化收益</p>
                <p style="font-size: 30px;color: #F72222;text-align: center;margin-left: 30px;margin-top: 12px">11%</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">投资期限</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">12个月</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">项目总额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥5000000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">已投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥670000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">剩余可投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥4330000</p>
            </div>
        </div>
    </div>
    <div style="background: #F7F7F9;height: 200px;border-bottom: 1px dashed">
        <div>
            <div style="float: left;font-size: 25px;color: #777;margin-top: 28px;margin-left: 66px">清风3期</div>
            <div><button class="btn btn-danger" style="margin-left: 30px;margin-top: 28px;font-size: 15px;">投资</button></div>
        </div>
        <div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-left: 30px;margin-top: 24px">年化收益</p>
                <p style="font-size: 30px;color: #F72222;text-align: center;margin-left: 30px;margin-top: 12px">10%</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">投资期限</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">6个月</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">项目总额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥1000000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">已投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥780000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">剩余可投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥220000</p>
            </div>
        </div>
    </div>
    <div style="background: #F7F7F9;height: 200px;border-bottom: 1px dashed">
        <div>
            <div style="float: left;font-size: 25px;color: #777;margin-top: 28px;margin-left: 66px">清风2期</div>
            <div><button class="btn btn-danger" style="margin-left: 30px;margin-top: 28px;font-size: 15px;">投资</button></div>
        </div>
        <div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-left: 30px;margin-top: 24px">年化收益</p>
                <p style="font-size: 30px;color: #F72222;text-align: center;margin-left: 30px;margin-top: 12px">9%</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">投资期限</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">3个月</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">项目总额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥100000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">已投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥80000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">剩余可投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥20000</p>
            </div>
        </div>
    </div>
    <div style="background: #F7F7F9;height: 200px;border-bottom: 1px dashed">
        <div>
            <div style="float: left;font-size: 25px;color: #777;margin-top: 28px;margin-left: 66px">清风1期</div>
            <div><button class="btn btn-danger" style="margin-left: 30px;margin-top: 28px;font-size: 15px;">投资</button></div>
        </div>
        <div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-left: 30px;margin-top: 24px">年化收益</p>
                <p style="font-size: 30px;color: #F72222;text-align: center;margin-left: 30px;margin-top: 12px">8%</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">投资期限</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">1个月</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">项目总额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥10000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">已投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥9000</p>
            </div>
            <div style="float: left;width: 186px">
                <p style="font-size: 20px;color: #666;text-align: center;margin-top: 24px">剩余可投金额</p>
                <p style="font-size: 30px;text-align: center;margin-top: 12px">¥1000</p>
            </div>
        </div>
    </div>
</div>

<!-- 平台注册人数和投资金额 -->
<div class="container col-lg-3">
    <div style="background: #F7F7F9">
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 5px">平台已成功运行</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">1天</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台总注册人数</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">132人</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台今日注册人数</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">2人</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台累计投资金额</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">¥123233</p>
            <p style="text-align: center;font-size: 20px;color: #777;margin-top: 8px">平台今日投资金额</p>
            <p style="text-align: center;font-size: 20px;color: #FEB974;margin-top: 5px">¥3233</p>
    </div>
</div>

@stop