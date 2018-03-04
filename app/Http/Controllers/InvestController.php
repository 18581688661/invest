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
use App\Models\Transaction_details;
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
                        'profit'=>(($request->invest_amount*$project->rate)/36500)*$project->project_time,
                        'invest_state'=>0,//0：回款中，1：已回款，2：已转让
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
                    $website_info->user_profit += (($request->invest_amount*$project->rate)/36500)*$project->project_time;
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

}