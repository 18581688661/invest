@extends('layouts.default')
@section('title', '加入公司')
@section('title1', '用户中心')
@section('content')
<div class="row">
    <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">

                <a href="{{ route('users.show', Auth::user()->get()->id) }}">
                <div class="wz ycdh">
                    <div class="tb tb1">
                            <p id="a1"><img src="/admin/public/img/dw1.png" alt=""><span>&nbsp报警情况</span></p>
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
                <div class="ry ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb4">
                        <p class="a3" style="color:#12BCFF"><img id="tb1-img" src="/admin/public/img/ej2.png" alt="">&nbsp加入公司</p>
                    </div>
                </div>
                </a>
       
            </div>
        </div>
        
        <!-- 右边 -->
        <div class=" col-lg-10">
            <div class="panel panel-default" style="margin-top: 0px">
    <div class="panel-heading">
      <h5>加入公司@if(Auth::user()->get()->company)（已加入公司：{{Auth::user()->get()->get_company_name(Auth::user()->get()->company)}}）@endif</h5>
    </div>
        <div class="panel-body">
            @include('shared.errors')
                <div class="form-group">
                    <form action="{{ route('join_company',Auth::user()->get()->id) }}" method="GET">
                        <label for="password">搜索公司：</label>
                        <input type="text" name="keyword" class="form-control">
                        <button type="submit" class="btn btn-info">搜索</button>
                    </form>
                </div>
            全部公司：
            @if (count($companies))
        <table class="table table-bordered">
            <tr>
                <td class="text-center" style="vertical-align: middle">公司名称</td>
                <td class="text-center" style="vertical-align: middle">公司简介</td>
                <td class="text-center" style="vertical-align: middle">公司地址</td>
                <td class="text-center" style="vertical-align: middle">公司邮箱</td>
                <td class="text-center" style="vertical-align: middle">公司邮编</td>
                <td class="text-center" style="vertical-align: middle">操作</td>
            </tr>
            @foreach ($companies as $company)
            <tr>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_name }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_introduction }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_address }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->email }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->postalcode }}</td>
                <td class="text-center" style="vertical-align: middle">
                    @if($company->id==$relation_id and $state==0)
                    <button class="btn" disabled>申请中</button>
                    @elseif($company->id==$relation_id and $state==1)
                    <button class="btn" disabled>已加入</button>
                    @else
                    <form action="{{ route('join_in',$company->id)}}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn">加入公司</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {!! $companies->render() !!}
    @else
    暂无数据！
    @endif
        </div>
  </div>
        </div>
</div>
@stop
