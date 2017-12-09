@extends('layouts.default')
@section('title','报警情况')
@section('title1','用户中心')
@section('content')
<div class="row">
    <!-- 左边 -->
    <div class="col-lg-2">
            <div class="yc">
                
                <a href="{{ route('users.show', Auth::user()->get()->id) }}">
                <div class="wz ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb1" style="color:#12BCFF">
                            <p id="a1"><img src="/admin/public/img/dw2.png" alt=""><span>&nbsp报警情况</span></p>
                    </div>
                </div>
                </a>

                <a href="{{ route('users.edit', Auth::user()->get()->id) }}">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ry1.png" alt="">&nbsp个人资料</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('join_company',Auth::user()->get()->id) }}">
                <div class="ry ycdh">
                    <div class="tb tb4">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ej1.png" alt="">&nbsp加入公司</p>
                    </div>
                </div>
                </a>         
            </div>
    </div>
    <!-- 右边 -->
        <div class=" col-lg-10">
            暂未开放！
        </div>
</div>
@stop