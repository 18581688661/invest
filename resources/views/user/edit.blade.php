@extends('layouts.default')
@section('title', '个人资料')
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
                <div class="ry ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb3">
                        <p class="a3" style="color:#12BCFF"><img id="tb1-img" src="/admin/public/img/ry2.png" alt="">&nbsp个人资料</p>
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
          <div class="panel panel-default">
          <div class="panel-heading">
          <h5>修改个人资料</h5>
          </div>
      <div class="panel-body">

        @include('shared.errors')

        <div class="gravatar_edit">
            <img src="@if(Auth::user()->get()->image_url)<?php echo '/images/'.$user->image_url ?>@else /images/all.png @endif" width="70";height="70" alt="{{ $user->name }}" class="gravatar"/>
        </div>

        <form method="POST" action="{{ route('users.update', $user->id )}}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            
            <div class="form-group">
              <div>
               <i class="fa fa-paperclip"></i>修改头像
               <input type="file" name="myfile"> 
              </div>
            </div>

            <div class="form-group">
              <label for="username">用户名：</label>
              <input type="text" name="username" class="form-control" value="{{ $user->username }}">
            </div>

            <div class="form-group">
              <label for="mobile">绑定手机号：</label>
              <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" disabled>
            </div>

            <div class="form-group">
              <label for="real_name">真实姓名：</label>
              <input type="text" name="real_name" class="form-control" value="{{ $user->real_name }}">
            </div>

            <div class="form-group">
              <label for="ID_card">身份证号：</label>
              <input type="text" name="ID_card" class="form-control" value="{{ $user->ID_card }}">
            </div>

            <div class="form-group">
              <label for="address">地址：</label>
              <input type="text" name="address" class="form-control" value="{{ $user->address }}">
            </div>

            <div class="form-group">
              <label for="delivery_address">收货地址：</label>
              <input type="text" name="delivery_address" class="form-control" value="{{ $user->delivery_address }}">
            </div>

            <div class="form-group">
              <label for="model">车型：</label>
              <input type="text" name="model" class="form-control" value="{{ $user->model }}">
            </div>

            <div class="form-group">
              <label for="plate">车牌号：</label>
              <input type="text" name="plate" class="form-control" value="{{ $user->plate }}">
            </div>

            <div class="form-group">
              <label for="driver_licence_num">驾驶证号：</label>
              <input type="text" name="driver_licence_num" class="form-control" value="{{ $user->driver_licence_num }}">
            </div>

            <div class="form-group">
              <label for="company">所属公司：</label>
              <input type="text" name="company" class="form-control" value=@if(Auth::user()->get()->company)"{{ Auth::user()->get()->get_company_name(Auth::user()->get()->company) }}"@else"暂未加入任何公司"@endif disabled>
            </div>

            <div class="form-group">
              <label for="password">密码：</label>
              <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>

            <div class="form-group">
              <label for="password_confirmation">确认密码：</label>
              <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
          </div>
      </div>
    </div>
</div>
@stop
