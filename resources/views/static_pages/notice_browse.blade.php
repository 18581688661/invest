@extends('layouts.default')
@section('title','平台公告')
@section('content')
<div class="container">
@if (count($notices))
    @foreach ($notices as $notice)
    
        <div class="panel panel-info text-center">
          <div class="panel-heading">
            <h5 style="font-size: 20px;">{{ $notice->title }}(发布时间：{{ $notice->time }})</h5>

        </div>
        <div class="panel-body">
            <p style="font-size: 18px;color: #666">{{ $notice->text }}</p>
            <hr>
            <p style="font-size: 18px;color: #666" align="right">【清风理财】运营团队</p>
        </div>
    </div>    
    @endforeach
    <div class="text-center">{!! $notices->render() !!}</div>
    @else
    暂无公告！
    @endif
    </div>
@stop