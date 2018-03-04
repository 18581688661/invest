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
}
