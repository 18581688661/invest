<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Alert;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'username'=>'required|max:25',
    		'password'=>'required|min:6'
    		]);
    	$credentials=['username'=>$request->username,'password'=>$request->password,];
    	if(Auth::user()->attempt($credentials,$request->has('remember')))
    	{
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
}
