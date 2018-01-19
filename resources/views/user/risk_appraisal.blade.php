@extends('layouts.default')
@section('title','实名认证')
@section('content')
<div class="container col-lg-2" style="border-right: 1px dashed">
	<ul class="nav nav-pills nav-stacked">
		<li style="text-align: center"><a href="{{ route('show') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户中心</a></li>
		<li style="text-align: center"><a href="{{ route('message') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp消息中心</a></li>
		<li style="text-align: center"><a href="#collapse1" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp资金管理</a></li>
        <div class="collapse " id="collapse1">
            <ul class="nav">
                <li style="text-align: center"><a href="#" style="font-size: 16px">交易记录</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">充值</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">提现</a></li>
                <li style="text-align: center"><a href="#" style="font-size: 16px">银行卡</a></li>
            </ul>
        </div>
        <li style="text-align: center"><a href="#collapse2" style="font-size: 17px" data-toggle="collapse"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp投资管理</a></li>
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
        <li style="text-align: center"><a href="{{ route('certification') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp实名认证</a></li>
        <li style="text-align: center" class="active"><a href="{{ route('risk_appraisal') }}" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp风险测评</a></li>
        <li style="text-align: center"><a href="#" style="font-size: 17px"><span class="glyphicon glyphicon-tag"></span>&nbsp&nbsp账户安全</a></li>
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
  <form action="">
    <div class="gcrisk_card" id="question1">
        <p class="gcrisk_title">1、您的年龄：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="age_1">20岁以下或65岁以上</label>
                <input type="radio" name="question1" id="age_1" hidden>
                <label for="age_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="age_2">51岁至65岁</label>
                <input type="radio" name="question1" id="age_2" hidden>
                <label for="age_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="age_3">21岁至30岁</label>
                <input type="radio" name="question1" id="age_3" hidden>
                <label for="age_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="age_4">31岁至50岁</label>
                <input type="radio" name="question1" id="age_4" hidden>
                <label for="age_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question2">
        <p class="gcrisk_title">2、您的教育程度：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="educated_1">高中以下</label>
                <input type="radio" name="question2" id="educated_1" hidden>
                <label for="educated_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="educated_2">大专</label>
                <input type="radio" name="question2" id="educated_2" hidden>
                <label for="educated_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="educated_3">本科</label>
                <input type="radio" name="question2" id="educated_3" hidden>
                <label for="educated_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="educated_4">研究生或研究生以上</label>
                <input type="radio" name="question2" id="educated_4" hidden>
                <label for="educated_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question3">
        <p class="gcrisk_title">3、您的健康状况：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="health_1">较差</label>
                <input type="radio" name="question3" id="health_1" hidden>
                <label for="health_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="health_2">一般</label>
                <input type="radio" name="question3" id="health_2" hidden>
                <label for="health_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="health_3">良好</label>
                <input type="radio" name="question3" id="health_3" hidden>
                <label for="health_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="health_4">很好</label>
                <input type="radio" name="question3" id="health_4" hidden>
                <label for="health_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question4">
        <p class="gcrisk_title">4、您目前的职业状况：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="job_1">企事业单位固定工作</label>
                <input type="radio" name="question4" id="job_1" hidden>
                <label for="job_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="job_2">私营业主</label>
                <input type="radio" name="question4" id="job_2" hidden>
                <label for="job_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="job_3">专业中介机构人员</label>
                <input type="radio" name="question4" id="job_3" hidden>
                <label for="job_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="job_4">专业投资人</label>
                <input type="radio" name="question4" id="job_4" hidden>
                <label for="job_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question5">
        <p class="gcrisk_title">5、您目前的年收入状况：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="income_1">50万以下</label>
                <input type="radio" name="question5" id="income_1" hidden>
                <label for="income_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="income_2">50-100万</label>
                <input type="radio" name="question5" id="income_2" hidden>
                <label for="income_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="income_3">100-200万</label>
                <input type="radio" name="question5" id="income_3" hidden>
                <label for="income_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="income_4">200万以上</label>
                <input type="radio" name="question5" id="income_4" hidden>
                <label for="income_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question6">
        <p class="gcrisk_title">6、您进行投资的主要目的是：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="destination_1">确保资产稳定的，同时获得固定收益</label>
                <input type="radio" name="question6" id="destination_1" hidden>
                <label for="destination_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="destination_2">希望投资能获得一定的增值，同时获得波动适度的年回报</label>
                <input type="radio" name="question6" id="destination_2" hidden>
                <label for="destination_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="destination_3">倾向于长期的成长，较少关心短期的回报和波动</label>
                <input type="radio" name="question6" id="destination_3" hidden>
                <label for="destination_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="destination_4">只关心长期的高回报，能够接受短期的资产价值波动</label>
                <input type="radio" name="question6" id="destination_4" hidden>
                <label for="destination_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question7">
        <p class="gcrisk_title">7、您对投资和资本市场的了解：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="knowledge_1">只对股票市场有一定了解</label>
                <input type="radio" name="question7" id="knowledge_1" hidden>
                <label for="knowledge_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="knowledge_2">了解和股票相关的衍生品市场的知识</label>
                <input type="radio" name="question7" id="knowledge_2" hidden>
                <label for="knowledge_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="knowledge_3">对非公开交易的资本市场也有一定得了解</label>
                <input type="radio" name="question7" id="knowledge_3" hidden>
                <label for="knowledge_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="knowledge_4">认识充分，对资本市场有深刻的理解</label>
                <input type="radio" name="question7" id="knowledge_4" hidden>
                <label for="knowledge_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question8">
        <p class="gcrisk_title">8、您的投资年限：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="time_1">少于2年</label>
                <input type="radio" name="question8" id="time_1" hidden>
                <label for="time_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="time_2">2年至5年</label>
                <input type="radio" name="question8" id="time_2" hidden>
                <label for="time_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="time_3">5年至10年</label>
                <input type="radio" name="question8" id="time_3" hidden>
                <label for="time_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="time_4">10年以上</label>
                <input type="radio" name="question8" id="time_4" hidden>
                <label for="time_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question9">
        <p class="gcrisk_title">9、您的主要投资品种：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="type_1">银行类理财产品</label>
                <input type="radio" name="question9" id="type_1" hidden>
                <label for="type_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="type_2">信托类产品</label>
                <input type="radio" name="question9" id="type_2" hidden>
                <label for="type_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="type_3">二级市场股票投资</label>
                <input type="radio" name="question9" id="type_3" hidden>
                <label for="type_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="type_4">期货类衍生品</label>
                <input type="radio" name="question9" id="type_4" hidden>
                <label for="type_4" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(5分)</span>
                <label for="type_5">股权投资</label>
                <input type="radio" name="question9" id="type_5" hidden>
                <label for="type_5" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question10">
        <p class="gcrisk_title">10、您进行投资的资金占家庭自有资金的比例：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="percent_1">15%以下</label>
                <input type="radio" name="question10" id="percent_1" hidden>
                <label for="percent_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="percent_2">15-30%</label>
                <input type="radio" name="question10" id="percent_2" hidden>
                <label for="percent_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="percent_3">30-50%</label>
                <input type="radio" name="question10" id="percent_3" hidden>
                <label for="percent_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="percent_4">50%以上</label>
                <input type="radio" name="question10" id="percent_4" hidden>
                <label for="percent_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question11">
        <p class="gcrisk_title">11、您进行股票投资时，能接受的投资期限一般是：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="deadline_1">1-2年</label>
                <input type="radio" name="question11" id="deadline_1" hidden>
                <label for="deadline_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="deadline_2">2-3年</label>
                <input type="radio" name="question11" id="deadline_2" hidden>
                <label for="deadline_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="deadline_3">3-5年</label>
                <input type="radio" name="question11" id="deadline_3" hidden>
                <label for="deadline_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="deadline_4">5年以上</label>
                <input type="radio" name="question11" id="deadline_4" hidden>
                <label for="deadline_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question12">
        <p class="gcrisk_title">12、您进行投资时所能承受的最大亏损比例是：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="deficit_1">50%以内</label>
                <input type="radio" name="question12" id="deficit_1" hidden>
                <label for="deficit_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="deficit_2">50-100%</label>
                <input type="radio" name="question12" id="deficit_2" hidden>
                <label for="deficit_2" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question13">
        <p class="gcrisk_title">13、您期望的投资年收益率以及对风险的认识：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="yield_1">10%，需要承担较低风险</label>
                <input type="radio" name="question13" id="yield_1" hidden>
                <label for="yield_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="yield_2">10-20%，需要承担中等风险</label>
                <input type="radio" name="question13" id="yield_2" hidden>
                <label for="yield_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="yield_3">20%以上，需要承担较高风险</label>
                <input type="radio" name="question13" id="yield_3" hidden>
                <label for="yield_3" class="radio_check"></label>
            </li>
        </ul>
    </div>
    <div class="gcrisk_card" id="question14">
        <p class="gcrisk_title">14、您如何看待投资亏损：</p>
        <ul class="gcrisk_items">
            <li class="clearfix">
                <span class="fr">(1分)</span>
                <label for="view_1">很难接受，影响正常的生活</label>
                <input type="radio" name="question14" id="view_1" hidden>
                <label for="view_1" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(2分)</span>
                <label for="view_2">受到一定的影响，但不影响正常生活</label>
                <input type="radio" name="question14" id="view_2" hidden>
                <label for="view_2" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(3分)</span>
                <label for="view_3">平常心看待，对情绪没有明显的影响</label>
                <input type="radio" name="question14" id="view_3" hidden>
                <label for="view_3" class="radio_check"></label>
            </li>
            <li class="clearfix">
                <span class="fr">(4分)</span>
                <label for="view_4">在获得高收益的同时遭受亏损的可能也在加大</label>
                <input type="radio" name="question14" id="view_4" hidden>
                <label for="view_4" class="radio_check"></label>
            </li>
        </ul>
    </div>
</form>
</div>
@stop