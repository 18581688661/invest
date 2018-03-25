<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Message;
use App\Models\Manager;
use App\Models\Transaction_details;
use App\Models\Project;
use App\Models\Withdrawals;
use App\Models\Website_info;
use App\Models\Invest;
use App\Models\Notice;
use Alert;
use Mail;
use Auth;

class ManagerController extends Controller
{
    public function mana_show()//个人中心
    {
        $id=Auth::manager()->get()->id;
        $manager = Manager::findOrFail($id);
        $signup_num=count(User::all());
        $today_signup_num=count(User::whereBetween('signup_time',array(Carbon::today(),Carbon::tomorrow()))->get());
        $startdate=strtotime(Carbon::parse('2018-01-01 00:00:00'));
        $enddate=strtotime(Carbon::now());
        $work_days=round(($enddate-$startdate)/3600/24); 
        $website_info=Website_info::findOrFail(1);
        $invests=Invest::whereBetween('invest_start_time',array(Carbon::today(),Carbon::tomorrow()))->get();
        $today_invest=0;
        foreach($invests as $invest)
        {
           $today_invest += $invest->invest_amount;
        }
        $projects=Project::all();
        $project_num=count($projects);
        $project_all_amount=0;
        foreach($projects as $project)
        {
            $project_all_amount += $project->project_amount;
        }

        $projects=Project::where('project_state',2)->get();
        $backing_amount=0;
        foreach($projects as $project)
        {
            $backing_amount += $project->project_amount;
        }

        $invests=Invest::where('invest_state',2)->get();
        $transferring_amount=0;
        foreach($invests as $invest)
        {
            $transferring_amount += $invest->invest_amount;
        }

        return view('manager.show',compact('backing_amount','transferring_amount','project_num','project_all_amount','today_invest','website_info','projects','signup_num','today_signup_num','work_days'));
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
                    $message=Message::create([
                        'user_id'=>$user->id,
                        'time'=>Carbon::now(),
                        'text'=>"您投资的项目【".$project->project_name."】已经按时回款，请前往个人中心查看详细信息！",
                        'state'=>0,
                        ]);
                }
            }
        }
        $projects=Project::orderBy('project_start_time', 'desc')->paginate(10);
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
            $message=Message::create([
                'user_id'=>$user->id,
                'time'=>Carbon::now(),
                'text'=>"您于【".$withdrawals->withdrawals_time."】申请的提现".$withdrawals->withdrawals_amount."元平台已经审核通过了，请关注银行到账信息！",
                'state'=>0,
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
            $message=Message::create([
                'user_id'=>$user->id,
                'time'=>Carbon::now(),
                'text'=>"您于【".$withdrawals->withdrawals_time."】申请的提现".$withdrawals->withdrawals_amount."元没有什么通过，原因为：".$request->remarks,
                'state'=>0,
                ]);
            Alert::success('处理成功！');
            return redirect()->back();
        }
    }

    public function notice_manage()
    {
        $notices=Notice::orderBy('time','desc')->paginate(5);
        return view('manager/notice_manage',compact('notices'));
    }

    public function notice_add(Request $request)
    {
        $notice=Notice::create([
                'title'=>$request->title,
                'text'=>$request->text,
                'time'=>Carbon::now(),
                ]);
            // session()->flash('success', '恭喜你，注册成功！');
            Alert::success('公告发布成功！');
            return redirect()->back();
    }

    public function notice_del(Request $request)
    {
        Notice::findOrFail($request->notice_id)->delete();
            Alert::success('公告删除成功！');
            return redirect()->back();
    }

    public function user_manage()
    {
        $users=User::paginate(10);
        return view('manager/user_manage',compact('users'));
    }

    public function user_search(Request $request)
    {
        $users=User::where('username','like','%'.$request->keyword.'%')->paginate(10);
        return view('manager/user_manage',compact('users'));
    }

    public function invest_his(Request $request)
    {
        $invests=Invest::where('project_id',$request->project_id)->whereBetween('invest_state',array(0,2))->paginate(10);
        return view('manager.invest_his',compact('invests'));
    }

    public function current_manage()
    {
        $website_info=Website_info::findOrFail(1);
        return view('manager.current_manage',compact('website_info'));
    }

    public function current_profit(Request $request)
    {
        $website_info=Website_info::findOrFail(1);
        $website_info->year_profit=$request->year_profit;
        $website_info->save();
        Alert::success('活期存款年化收益率修改成功！');
        return redirect()->back();
    }
}
