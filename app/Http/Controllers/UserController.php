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
        'ID_card' => 'required'
        ]);
        $ID_card=$request->ID_card;
        $flag=$this->is_idcard($ID_card);
        if($flag)
        {
            $user=Auth::user()->get();
            $user->real_name=$request->real_name;
            $user->ID_card=$request->ID_card;
            $user->certification_time=Carbon::now();
            $user->save();
            Alert::success('恭喜你，认证成功！');
            return redirect()->back();
        }
        else
        {
            Alert::warning('身份证输入有误，请重新输入！');
            return redirect()->back();
        }        
    }

    public function risk_appraisal()
    {
        return view('user.risk_appraisal');
    }

    public function appraisal(Request $request)
    {
        $score=0;
        for($i=1;$i<=14;$i++)
        {
            $question='question'.$i;
            $score+=$request->$question;
        }
        $user=Auth::user()->get();
        $user->risk_time=Carbon::now();
        $user->risk_score=$score;
        $user->save();
        if($score>30)
        {
            Alert::success('恭喜，您是合格的投资人！');
        }
        else
        {
            Alert::warning('对不起，您不是合格的投资人！');
        }
        
        return redirect()->back();
    }

    protected function email()  //发送邮件
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

    public function is_idcard($id)  //验证身份证
    {      
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $id)) {
            return FALSE;
        }
        if (15 == strlen($id)) //检查15位 
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确 
            $dtm_birth = "19".$arr_split[2].'/'.$arr_split[3].'/'.$arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else //检查18位 
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";@preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2].'/'.$arr_split[3].'/'.$arr_split[4];
            if (!strtotime($dtm_birth)) //检查生日日期是否正确 
            {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。 
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。 
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int) $id {
                        $i
                    };
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return FALSE;
                } //phpfensi.com 
                else {
                    return TRUE;
                }
            }
        }
    }
}
