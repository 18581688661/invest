<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Alert;
use Carbon\Carbon;

class SessionsController extends Controller
{
    public function create()//用户登录
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'username'=>'required|max:25',
    		'password'=>'required|min:6',
            'captcha' =>'captcha'
    		]);
    	$credentials=['username'=>$request->username,'password'=>$request->password,];
    	if(Auth::user()->attempt($credentials,$request->has('remember')))
    	{
            $user=Auth::user()->get();
            //数据库里面使用两个字段来存储登录时间,一个是上次登录时间,一个是本次登录时间.每次用户登录的时候,将本次登录时间存入上次登录时间中,将当前时间存入本次登录时间字段中
            $user->last_login_time=$user->this_login_time;
            $user->this_login_time=Carbon::now();
            $user->save();
            // session()->flash('success','欢迎回来！');
            Alert::success('欢迎回来！'); 
            // return redirect()->intended(route('user.show',[Auth::user()->get()]));
            return redirect()->intended(route('show'));
    	}
    	else
    	{
    		// session()->flash('danger','很抱歉，您的用户名和密码不匹配，请重新登录');
            Alert::error('用户名或密码错误，请重新输入！'); 
    		return redirect()->back();
    	}
    }

    public function destroy()
    {
        Auth::logout();
        // session()->flash('success','您已成功退出！');
        Alert::info('您已成功退出登录！'); 
        return redirect('/');
    }

    public function mana_create()//管理员登录
    {
        return view('sessions.mana_create');
    }

    public function mana_store(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|max:25',
            'password'=>'required|min:6',
            'captcha' =>'captcha'
            ]);
        $credentials=['username'=>$request->username,'password'=>$request->password,];
        if(Auth::manager()->attempt($credentials,$request->has('remember')))
        {
            $manager=Auth::manager()->get();
            //数据库里面使用两个字段来存储登录时间,一个是上次登录时间,一个是本次登录时间.每次用户登录的时候,将本次登录时间存入上次登录时间中,将当前时间存入本次登录时间字段中
            $manager->last_login_time=$manager->this_login_time;
            $manager->this_login_time=Carbon::now();
            $manager->save();
            // session()->flash('success','欢迎回来！');
            Alert::success('欢迎回来！'); 
            // return redirect()->intended(route('manager.show',[Auth::manager()->get()]));
            return redirect()->intended(route('mana_show'));
        }
        else
        {
            // session()->flash('danger','很抱歉，您的用户名和密码不匹配，请重新登录');
            Alert::error('用户名或密码错误，请重新输入！'); 
            return redirect()->back();
        }
    }
}
