<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Project;
use App\Models\User;
use App\Models\Invest;
use App\Models\Website_info;
use App\Models\Transaction_details;
use Alert;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Alert::success('恭喜你，成功投资50000元！')->persistent('关闭');//手动关闭
        $signup_num=count(User::all());
        $today_signup_num=count(User::whereBetween('signup_time',array(Carbon::today(),Carbon::tomorrow()))->get());
        $startdate=strtotime(Carbon::parse('2018-01-01 00:00:00'));
        $enddate=strtotime(Carbon::now());
        $work_days=round(($enddate-$startdate)/3600/24); 
        $website_info=Website_info::findOrFail(1);
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
                $invests=Invest::where('project_id',$project->id)->get();
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
        $invests=Invest::whereBetween('invest_start_time',array(Carbon::today(),Carbon::tomorrow()))->get();
        $today_invest=0;
        foreach($invests as $invest)
        {
           $today_invest += $invest->invest_amount;
        }
        return view('static_pages/index',compact('today_invest','website_info','projects','signup_num','today_signup_num','work_days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
