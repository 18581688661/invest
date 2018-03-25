<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Project;
use App\Models\Invest;
use App\Models\Website_info;
use App\Models\Message;
use App\Models\Transaction_details;
use App\Models\Current;
use Alert;
use Mail;
use Auth;

class InvestController extends Controller
{
    public function invest(Request $request)
    {
        if ($request->capital_password == Auth::user()->get()->capital_password) {
            $project=Project::findOrFail($request->project_id);
            $user=Auth::user()->get();
            if($request->invest_amount>$project->amount_wait)
            {
                Alert::info('对不起，投资金额超出可投金额！');
                return redirect()->back();
            }
            else
            {
                if($request->invest_amount <= $user->balance)
                {
                    $invest=Invest::create([
                        'user_id'=>$user->id,
                        'project_id'=>$project->id,
                        'project_name'=>$project->project_name,
                        'invest_amount'=>$request->invest_amount,
                        'invest_start_time'=>Carbon::now(),
                        'project_stop_time'=>$project->project_stop_time,
                        $startdate=strtotime(Carbon::now()),
                        $enddate=strtotime(Carbon::parse($project->project_stop_time)),
                        $yuqi_time=round(($enddate-$startdate)/3600/24), //预期投资天数
                        'profit'=>(($request->invest_amount*$project->rate)/36500)*$yuqi_time,
                        'invest_state'=>0,//0：回款中，1：已回款，2：转让中，3：已转让
                        'remarks'=>'主动投资',
                        ]);
                    $project->amount_invested += $request->invest_amount;
                    $project->amount_wait -= $request->invest_amount;
                    $project->invest_user_amount ++;
                    if($project->amount_wait == 0)
                    {
                        $project->project_state = 2;
                    }
                    $project->save();
                    $website_info=Website_info::findOrFail(1);
                    $website_info->total_investment += $request->invest_amount;
                    $startdate=strtotime(Carbon::parse($invest->invest_start_time));
                    $enddate=strtotime(Carbon::parse($invest->project_stop_time));
                    $yuqi_time=round(($enddate-$startdate)/3600/24); //预期投资天数
                    $website_info->user_profit += (($request->invest_amount*$project->rate)/36500)*$yuqi_time;
                    $website_info->save();
                    $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'投资支出',
                        'amount'=>$request->invest_amount,
                        'remarks'=>'投资项目支出-'.$project->project_name,
                        ]);
                    $user->balance -= $request->invest_amount;
                    $user->save();
                    $message=Message::create([
                        'user_id'=>$user->id,
                        'time'=>Carbon::now(),
                        'text'=>"您已成功投资项目【".$project->project_name."】".$request->invest_amount."元！",
                        'state'=>0,
                        ]);
                    Alert::success('恭喜你，投资成功！');
                    return redirect()->back();
                }
                else
                {
                    Alert::info('对不起，余额不足！');
                    return redirect()->back();
                }
            }
        }
        else
        {
            // session()->flash('danger', '短信验证码输入有误，请重新输入！');
            Alert::error('资金密码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function transferring()
    {
        $invests=Invest::where('invest_state',2)->orderBy('transfer_time', 'desc')->paginate(10);
        return view('user/transferring',compact('invests'));
    }

    public function project_invested()
    {
        $invests=Invest::where('user_id',Auth::user()->get()->id)->orderBy('invest_start_time', 'desc')->paginate(10);
        return view('user/project_invested',compact('invests'));
    }

    public function project_backing()
    {
        $invests=Invest::where('user_id',Auth::user()->get()->id)->where('invest_state',0)->orderBy('invest_start_time', 'desc')->paginate(10);
        return view('user/project_backing',compact('invests'));
    }

    public function project_backed()
    {
        $invests=Invest::where('user_id',Auth::user()->get()->id)->where('invest_state',1)->orderBy('invest_start_time', 'desc')->paginate(10);
        return view('user/project_backed',compact('invests'));
    }

    public function project_transferring()
    {
        $invests=Invest::where('user_id',Auth::user()->get()->id)->where('invest_state',2)->orderBy('invest_start_time', 'desc')->paginate(10);
        return view('user/project_transferring',compact('invests'));
    }

    public function project_transferred()
    {
        $invests=Invest::where('user_id',Auth::user()->get()->id)->where('invest_state',3)->orderBy('invest_start_time', 'desc')->paginate(10);
        return view('user/project_transferred',compact('invests'));
    }

    public function transfer(Request $request)
    {
        if ($request->capital_password == Auth::user()->get()->capital_password) {
            $invest=Invest::findOrFail($request->invest_id);
            $invest->invest_state = 2;

            $startdate=strtotime(Carbon::parse($invest->invest_start_time));
            $enddate=strtotime(Carbon::now());
            $shiji_time=round(($enddate-$startdate)/3600/24); //实际投资天数

            $startdate1=strtotime(Carbon::parse($invest->invest_start_time));
            $enddate1=strtotime(Carbon::parse($invest->project_stop_time));
            $yuqi_time=round(($enddate1-$startdate1)/3600/24); //完整投资天数

            $invest->profit = (($invest->profit*$shiji_time)/$yuqi_time);
            $invest->transfer_time=Carbon::now();
            $invest->save();
            Alert::success('发布转让信息成功,请耐心等待转让完成！本项目实际获得收益：¥'.$invest->profit)->persistent('Close');
            return redirect()->back();
        }
        else
        {
            Alert::error('资金密码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function buy_transfer(Request $request)
    {
        if ($request->capital_password == Auth::user()->get()->capital_password) {
            $invest=Invest::findOrFail($request->invest_id);
            $project=Project::findOrFail($invest->project_id);

            $user=Auth::user()->get();
            $user1=User::findOrFail($invest->user_id);
            if($invest->invest_amount <= $user->balance)
            {
                //转让人相关操作
                $invest->transfer_success_time=Carbon::now();
                $invest->invest_state=3;
                $invest->save();
                $user1->balance += $invest->invest_amount;
                $transaction_detail=Transaction_details::create([
                        'user_id'=>$user1->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'项目转让(本金)',
                        'amount'=>$invest->invest_amount,
                        'remarks'=>'项目转让成功-'.$project->project_name,
                        ]);
                $user1->balance += $invest->profit;
                $transaction_detail=Transaction_details::create([
                        'user_id'=>$user1->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'项目转让(收益)',
                        'amount'=>$invest->profit,
                        'remarks'=>'项目转让成功-'.$project->project_name,
                        ]);
                $user1->profit += $invest->profit;
                $message=Message::create([
                        'user_id'=>$user1->id,
                        'time'=>Carbon::now(),
                        'text'=>"您转让的项目【".$project->project_name."】已经成功转让，请前往个人中心查看详细信息！",
                        'state'=>0,
                        ]);
                $user1->save();

                //购买人相关操作
                $invest1=Invest::create([
                    'user_id'=>$user->id,
                    'project_id'=>$project->id,
                    'project_name'=>$project->project_name,
                    'invest_amount'=>$invest->invest_amount,
                    'invest_start_time'=>Carbon::now(),
                    'project_stop_time'=>$project->project_stop_time,
                    $startdate=strtotime(Carbon::now()),
                    $enddate=strtotime(Carbon::parse($project->project_stop_time)),
                        $yuqi_time=round(($enddate-$startdate)/3600/24), //预期投资天数
                        'profit'=>(($invest->invest_amount*$project->rate)/36500)*$yuqi_time,
                        'invest_state'=>0,//0：回款中，1：已回款，2：转让中，3：已转让
                        'remarks'=>'购买转让',
                        ]);
                $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'购买转让',
                        'amount'=>$invest->invest_amount,
                        'remarks'=>'购买转让-'.$project->project_name,
                        ]);
                $user->balance -= $invest->invest_amount;
                $user->save();
                $message=Message::create([
                        'user_id'=>$user->id,
                        'time'=>Carbon::now(),
                        'text'=>"您已成功购买转让项目【".$project->project_name."】".$invest->invest_amount."元！",
                        'state'=>0,
                        ]);
                    Alert::success('恭喜你，转让购买成功！');
                    return redirect()->back();
                }
                else
                {
                    Alert::info('对不起，余额不足！');
                    return redirect()->back();
                }
        }
        else
        {
            Alert::error('资金密码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function current_deposit()
    {
        $currents=Current::where('user_id',Auth::user()->get()->id)->where('state',0)->get();
        $current_amount=0;
        foreach( $currents as $current )
        {
            $current_amount += $current->invest_amount;
        }
        $website_info=Website_info::findOrFail(1);
        $currents=Current::where('user_id',Auth::user()->get()->id)->orderBy('invest_start_time','desc')->paginate(10);
        return view('user.current_deposit',compact('currents','current_amount','website_info'));
    }

    public function deposit(Request $request)
    {
        if ($request->capital_password == Auth::user()->get()->capital_password)
        {
            $user=Auth::user()->get();
            if($user->balance >= $request->invest_amount)
            {
                $user->balance -= $request->invest_amount;
                $user->save();
                $website_info=Website_info::findOrFail(1);
                $website_info->current_amount += $request->invest_amount;
                $website_info->save();
                $current=Current::create([
                    'user_id'=>$user->id,
                    'invest_amount'=>$request->invest_amount,
                    'invest_start_time'=>Carbon::now(),
                    'state'=>0,
                    'profit'=>0,
                    ]);

                $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'存款支出',
                        'amount'=>$request->invest_amount,
                        'remarks'=>'活期存款',
                        ]);
                $message=Message::create([
                        'user_id'=>$user->id,
                        'time'=>Carbon::now(),
                        'text'=>"您已成功购买活期存款¥".$request->invest_amount."元！",
                        'state'=>0,
                        ]);

                Alert::success('恭喜你，活期存款购买成功！');
                return redirect()->back();
            }
            else
            {
                Alert::info('对不起，余额不足！');
                return redirect()->back();
            }
        }
        else{
            Alert::error('资金密码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function current_redeem(Request $request)
    {
        if ($request->capital_password == Auth::user()->get()->capital_password)
        {
            $current=Current::findOrFail($request->current_id);
            $current->invest_stop_time=Carbon::now();
            $current->profit=$request->profit;
            $current->state=1;
            $current->save();
            $user=Auth::user()->get();
            $user->balance += $current->invest_amount;
            $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'活期存款赎回',
                        'amount'=>$current->invest_amount,
                        'remarks'=>'活期存款赎回',
                        ]);
            $website_info=Website_info::findOrFail(1);
            $website_info->current_amount -= $current->invest_amount;
            $website_info->save();
            $user->balance += $current->profit;
            $user->profit += $current->profit;
            $user->save();
            $website_info=Website_info::findOrFail(1);
                $website_info->current_profit += $current->profit;
                $website_info->save();
            $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'利息收入',
                        'amount'=>$current->profit,
                        'remarks'=>'活期存款利息收入',
                        ]);
                $message=Message::create([
                        'user_id'=>$user->id,
                        'time'=>Carbon::now(),
                        'text'=>"您已成功赎回活期存款¥".$current->invest_amount."元！",
                        'state'=>0,
                        ]);
                Alert::success('恭喜你，活期存款赎回成功！');
                return redirect()->back();
        }
        else
        {
            Alert::error('资金密码输入有误，请重新输入！');
            return redirect()->back();
        }
    }
}