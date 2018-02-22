<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Manager;
use App\Models\Transaction_details;
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
    	return view('manager.project_manage');
    }

    public function project_add(Request $request)
    {
开始写;
    }
}
