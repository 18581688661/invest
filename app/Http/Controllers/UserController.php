<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use Alert;
use Mail;
use Auth;

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
        'email'    => 'required|email',//测试完改回唯一
        'verification_code' =>'required|digits:6'
        ]);
        if ($request->verification_code==$_SESSION["verify_code"]) {
            $user=User::create([
                'username'=>$request->username,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                ]);
            // session()->flash('success', '恭喜你，注册成功！');
            Alert::success('恭喜你，注册成功！');
            return redirect('/');
        }
        else
        {
            // session()->flash('danger', '短信验证码输入有误，请重新输入！');
            Alert::error('验证码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function getReset()//找回密码页
    {
        return view('user.password_reset');
    }

    public function postRset(Request $request)//找回密码操作
    {
        session_start();
        $this->validate($request, [
        'password' => 'required|confirmed|min:6',
        'email' => 'required|email',
        'verification_code' =>'required|digits:6'
        ]);
        if($user=User::where('email',$request->email)->first())
        {
            if ($request->verification_code==$_SESSION["verify_code"]) {
            $user->update([
            'password' => bcrypt($request->password),
            ]);
            // session()->flash('success', '恭喜你，密码修改成功！');
            Alert::success('恭喜你,密码修改成功!');
            return redirect('/');
            }
            else
            {
                // session()->flash('danger', '验证码输入有误，请重新输入！');
                Alert::error('验证码输入有误，请重新输入！');
                return redirect()->back();
            }
        }
        else
        {
            // session()->flash('danger', '手机号不存在，请重新输入！');
            Alert::info('该邮箱尚未注册,请重新输入！');
            return redirect()->back();
        }
        
    }

    public function show()//个人中心
    {
        $id=Auth::user()->get()->id;
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function message()//消息中心
    {
        return view('user.message');
    }

    public function certification()
    {
        return view('user.certification');
    }

    public function certificate(Request $request)
    {
        $this->validate($request, [
        'real_name' => 'required',
        'ID_card' => 'required|digits:18'
        ]);
        $user=Auth::user()->get();
        $user->real_name=$request->real_name;
        $user->ID_card=$request->ID_card;
        $user->certification_time=Carbon::now();
        $user->save();
        Alert::success('恭喜你，认证成功！');
        return redirect()->back();
    }

    public function risk_appraisal()
    {
        return view('user.risk_appraisal');
    }

    protected function email()//发送邮件
    {
        Session_Start();
        $code=rand(100000,999999);
        $_SESSION["verify_code"]=$code;
        Mail::send('email.signup',['code'=>$code],function($message){
            $to = $_GET["email"];
            $message ->to($to)->subject('【清风理财】验证码');
        });
        // return response()->json(['success']);
    }
}
