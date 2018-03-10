<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Manager;
use App\Models\Transaction_details;
use App\Models\Project;
use App\Models\Withdrawals;
use Alert;
use Mail;
use Auth;

class ManagerController extends Controller
{
    public function mana_show()//个人中心
    {
        $id=Auth::manager()->get()->id;
        $manager = Manager::findOrFail($id);
        return view('manager.show');
    }

    public function project_manage()
    {
        $projects=Project::all();
        foreach($projects as $project) {
            if(Carbon::now()->gte(Carbon::parse($project->project_start_time)) && $project->project_state==0)
            {
                $project->project_state=1;
                $project->save();
            }
            if(Carbon::now()->gte(Carbon::parse($project->project_stop_time)) && $project->project_state==2)
            {
                $project->project_state=3;
                $project->save();
                $invests=Invest::where('project_id',$project->id)->where('invest_state',0)->get();
                foreach($invests as $invest)
                {
                    $invest->invest_state = 1;
                    $user=User::findOrFail($invest->user_id);
                    $user->balance += $invest->profit;
                    $user->balance += $invest->invest_amount;
                    $user->profit += $invest->profit;
                    $invest->save();
                    $user->save();
                    $project=Project::findOrFail($invest->project_id);
                    $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'项目回款(本金)',
                        'amount'=>$invest->invest_amount,
                        'remarks'=>'项目回款-'.$project->project_name,
                        ]);
                    $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'项目回款(收益)',
                        'amount'=>$invest->profit,
                        'remarks'=>'项目回款-'.$project->project_name,
                        ]);
                }
            }
        }
        $projects=Project::orderBy('project_start_time', 'desc')->get();
    	return view('manager.project_manage',compact('projects'));
    }

    public function project_add(Request $request)
    {
        $this->validate($request, [
        'project_name' => 'required|max:12',
        'project_amount' => 'required',
        'rate'    => 'required',
        'project_start_time' =>'required',
        'project_time'    => 'required',
        'project_intro' =>'required'
        ]);
        $project=Project::create([
                'project_name'=>$request->project_name,
                'project_amount'=>$request->project_amount,
                'rate'=>$request->rate,
                'project_start_time'=>$request->project_start_time,
                'project_time'=>$request->project_time,
                'project_intro'=>$request->project_intro,
                'project_state'=>0,//0：未开始，1：投资中，2：回款中，3：已回款
                'amount_invested'=>0,
                'amount_wait'=>$request->project_amount,
                'project_stop_time'=>Carbon::parse($request->project_start_time)->addDays($request->project_time),
                ]);
            // session()->flash('success', '恭喜你，注册成功！');
            Alert::success('恭喜你，项目添加成功！');
            return redirect()->back();
    }

    public function withdrawals_manage()
    {
        $withdrawals=Withdrawals::where('state',0)->paginate(10);
        return view('manager/withdrawals_manage',compact('withdrawals'));
    }

    public function all_withdrawals()
    {
        $withdrawals=Withdrawals::orderBy('withdrawals_time','desc')->paginate(10);
        return view('manager/all_withdrawals',compact('withdrawals'));
    }

    public function withdrawals_handle(Request $request)
    {
        $withdrawals=Withdrawals::findOrFail($request->withdrawals_id);
        $pass=$request->pass;
        $user=User::findOrFail($withdrawals->user_id);

        if($pass == 1)
        {
            $withdrawals->state=1;
            $withdrawals->handle_time=Carbon::now();
            $withdrawals->remarks=$request->remarks;
            $withdrawals->save();

            $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'提现成功',
                        'amount'=>$withdrawals->withdrawals_amount,
                        'remarks'=>'提现成功-'.$request->remarks,
                        ]);
            Alert::success('处理成功！');
            return redirect()->back();
        }

        else
        {
            $withdrawals->state=2;
            $withdrawals->handle_time=Carbon::now();
            $withdrawals->remarks=$request->remarks;
            $withdrawals->save();
            $user->balance += $withdrawals->withdrawals_amount;
            $user->save();
            $transaction_detail=Transaction_details::create([
                        'user_id'=>$user->id,
                        'transaction_time'=>Carbon::now(),
                        'transaction_type'=>'提现失败',
                        'amount'=>$withdrawals->withdrawals_amount,
                        'remarks'=>'提现失败-'.$request->remarks,
                        ]);
            Alert::success('处理成功！');
            return redirect()->back();
        }
    } 
}
