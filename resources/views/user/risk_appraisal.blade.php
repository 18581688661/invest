@extends('layouts.default')
@section('title','实名认证')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-bell"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse " id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">银行卡</a></li>
            </ul>
        </div>
        <li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-yen"></span>&nbsp&nbsp投资管理</a></li>
        <div class="collapse " id="collapse2">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">所有已投项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">回款中项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">已回款项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">转让中项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">已转让项目</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">零活宝</a></li>
            </ul>
        </div>
        <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp实名认证</a></li>
        <li style="text-align: center" class="active"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-file"></span>&nbsp&nbsp风险测评</a></li>
        <li style="text-align: center"><a href="{{ route('security') }}" style="font-size: 17px"><span class="glyphicon glyphicon-lock"></span>&nbsp&nbsp账户安全</a></li>
    </ul>
</div>
<div class="container col-lg-10">
  <h4 style="border-left: 3px solid #FFAC2A;font-size: 20px;margin-top: 22px">&nbsp&nbsp投资人风险承受能力测评</h4>
  @if(Auth::user()->get()->risk_score)
  <p style="font-size: 14px;color: #999;margin-top: 20px">您在{{Auth::user()->get()->risk_time}}进行了测评，分数为{{Auth::user()->get()->risk_score}}，@if(Auth::user()->get()->risk_score>30)您是合格的投资人！@else您不是合格的投资人！@endif您也可以重新进行测评。</p>
  @else
  <p style="font-size: 14px;color: #999;margin-top: 20px">您还未进行过风险测评！</p>
  @endif
  <h3 class="text-center">评估问卷</h3>
  <p style="color: #999">本着对投资人负责的态度，专门设计了本调查问卷，请在下列各题的答案中选择最合适的答案，下列问题将有助于您清楚地了解自己的风险偏好及风险承受能力，有助于您控制投资风险。最后，请根据您的测评结果，谨慎做出是否投资的决策。我们将承诺对您的个人资料严格保密。</p>
  <form method="POST" action="{{ route('appraisal') }}">
    {{ csrf_field() }}
    <p style="font-weight:600">1、您的年龄：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question1" value="1" checked>
            20岁以下或65岁以上(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question1" value="2">
            51岁至65岁(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question1" value="3">
            21岁至30岁(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question1" value="4">
            31岁至50岁(4分)
        </label>
    </div>
    <p style="font-weight:600">2、您的教育程度：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question2" value="1" checked>
            高中以下(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question2" value="2">
            大专(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question2" value="3">
            本科(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question2" value="4">
            研究生或研究生以上(4分)
        </label>
    </div>    
    <p style="font-weight:600">3、您的健康状况：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question3" value="1" checked>
            较差(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question3" value="2">
            一般(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question3" value="3">
            良好(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question3" value="4">
            很好(4分)
        </label>
    </div>

    <p style="font-weight:600">4、您目前的职业状况：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question4" value="1" checked>
            企事业单位固定工作(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question4" value="2">
            私营业主(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question4" value="3">
            专业中介机构人员(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question4" value="4">
            专业投资人(4分)
        </label>
    </div>


    <p style="font-weight:600">5、您目前的年收入状况：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question5" value="1" checked>
            50万以下(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question5" value="2">
            50-100万(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question5" value="3">
            100-200万(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question5" value="4">
            200万以上(4分)
        </label>
    </div>
    <p style="font-weight:600">6、您进行投资的主要目的是：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question6" value="1" checked>
            确保资产稳定的，同时获得固定收益(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question6" value="2">
            希望投资能获得一定的增值，同时获得波动适度的年回报(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question6" value="3">
            倾向于长期的成长，较少关心短期的回报和波动(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question6" value="4">
            只关心长期的高回报，能够接受短期的资产价值波动(4分)
        </label>
    </div>
    <p style="font-weight:600">7、您对投资和资本市场的了解：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question7" value="1" checked>
            只对股票市场有一定了解(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question7" value="2">
            了解和股票相关的衍生品市场的知识(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question7" value="3">
            对非公开交易的资本市场也有一定得了解(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question7" value="4">
            认识充分，对资本市场有深刻的理解(4分)
        </label>
    </div>
    <p style="font-weight:600">8、您的投资年限：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question8" value="1" checked>
            少于2年(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question8" value="2">
            2年至5年(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question8" value="3">
            5年至10年(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question8" value="4">
            10年以上(4分)
        </label>
    </div>
    <p style="font-weight:600">9、您的主要投资品种：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question9" value="1" checked>
            银行类理财产品(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question9" value="2">
            信托类产品(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question9" value="3">
            二级市场股票投资(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question9" value="4">
            期货类衍生品(4分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question9" value="5">
            股权投资(5分)
        </label>
    </div>
    <p style="font-weight:600">10、您进行投资的资金占家庭自有资金的比例：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question10" value="1" checked>
            15%以下(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question10" value="2">
            15-30%(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question10" value="3">
            30-50%(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question10" value="4">
            50%以上(4分)
        </label>
    </div>
    <p style="font-weight:600">11、您进行股票投资时，能接受的投资期限一般是：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question11" value="1" checked>
            1-2年(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question11" value="2">
            2-3年(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question11" value="3">
            3-5年(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question11" value="4">
            5年以上(4分)
        </label>
    </div>
    <p style="font-weight:600">12、您进行投资时所能承受的最大亏损比例是：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question12" value="1" checked>
            50%以内(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question12" value="2">
            50-100%(2分)
        </label>
    </div>
    <p style="font-weight:600">13、您期望的投资年收益率以及对风险的认识：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question13" value="1" checked>
            10%，需要承担较低风险(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question13" value="2">
            10-20%，需要承担中等风险(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question13" value="3">
            20%以上，需要承担较高风险(3分)
        </label>
    </div>
    <p style="font-weight:600">14、您如何看待投资亏损：</p>
    <div class="radio">
        <label>
            <input type="radio" name="question14" value="1" checked>
            很难接受，影响正常的生活(1分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question14" value="2">
            受到一定的影响，但不影响正常生活(2分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question14" value="3">
            平常心看待，对情绪没有明显的影响(3分)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="question14" value="4">
            在获得高收益的同时遭受亏损的可能也在加大(4分)
        </label>
    </div>
    <button type="submit" class="btn btn-success">提交</button>
</form>
</div>
@stop