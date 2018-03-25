@extends('layouts.default')
@section('title','实名认证')
@section('content')
<div  style="width: 100%;height: 50px;">
    <form>
        <input type="submit" class="btn " value="签到">
    </form>
</div>
<div id="allmap" style="width: 100%;height: 600px;">

</div>
@stop
@section('script')
<script type="text/javascript">

//创建地图
var map = new BMap.Map("allmap");

//创建一个圆
var circle = new BMap.Circle(new BMap.Point(104.0767123581,30.5376945271),100,{fillColor:"blue", strokeWeight: 1 ,fillOpacity: 0.3, strokeOpacity: 0.3});

//定位操作
$(function() {
  // 百度地图API功能  
  map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件  
  map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件  
  map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件  
  map.enableScrollWheelZoom();                            //启用滚轮放大缩小  
  map.addControl(new BMap.MapTypeControl());          //添加地图类型控件  
  map.addOverlay(circle);
  
    //初始化地图 默认加载成都大学(成大坐标104.1935125878,30.6541733135)(现在是齐晟的坐标！！！)
    
    var point = new BMap.Point(104.0767123581,30.5376945271);
    map.centerAndZoom(point,18);//初始化地图，point为中心点，缩放级别为18
    //判断手机浏览器是否支持定位
    if(navigator.geolocation){
        var geolocation = new BMap.Geolocation();//创建定位实例
        geolocation.getCurrentPosition(showLocation,{enableHighAccuracy: true});//enableHighAccuracy 要求浏览器获取最佳结果
    }else{
        map.addControl(new BMap.GeolocationControl());//添加定位控件 支持定位
    }
});

//处理定位后的信息
function showLocation(r){
    if(this.getStatus() == BMAP_STATUS_SUCCESS){//定位成功
        //新建中心点 并将地图中心移动过去
        var centerPoint = new BMap.Point(r.longitude,r.latitude);
        map.panTo(centerPoint);
        map.setCenter(centerPoint);
        //新建标注
        var mk = new BMap.Marker(centerPoint);
        // mk.disableDragging();// 不可拖拽
        map.addOverlay(mk);

        //判断点是否在圈内(依赖于GeoUtils_min.js)
        if(BMapLib.GeoUtils.isPointInCircle(centerPoint,circle)){
            alert("在范围内，可以打卡！！");

        }else
        {
            alert("不在范围内，禁止打卡！！");
            //这里加上自己的逻辑，如：禁止点击签到按钮
        }
    }
    else {
            alert('failed'+this.getStatus());//定位失败
        }        
    }
    </script>
    @stop