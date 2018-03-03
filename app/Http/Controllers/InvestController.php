<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Project;
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