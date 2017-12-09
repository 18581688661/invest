<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Alert;

class UserController extends Controller
{
    public function create()//用户注册页面
    {
        // Alert::success('恭喜你，注册成功！')->autoclose(2000);//2秒自动关闭
        // Alert::success('恭喜你，注册成功！')->persistent('关闭');//手动关闭
        return view('user.create');
    }

    public function store(Request $request)//用户注册
    {
        session_start();
        $this->validate($request, [
        'username' => 'required|max:50|unique:user',
        'password' => 'required|confirmed|min:6',
        'email'    => 'required|email|unique:user',
        'verification_code' =>'required|digits:6'
        ]);
        // if ($request->verification_code==$_SESSION["verify_code"]) {
        $user=User::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            ]);
        // $this->sendEmailConfirmationTo($user);
        // session()->flash('success', '恭喜你，注册成功！');
        Alert::success('恭喜你，注册成功！');
        return redirect('/');
        // }
        // else
        // {
        //     session()->flash('danger', '短信验证码输入有误，请重新输入！');
        //     return redirect()->back();
        // }
    }
}
