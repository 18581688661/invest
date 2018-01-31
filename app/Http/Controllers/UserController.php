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

    public function certification()//实名认证页
    {
        return view('user.certification');
    }

    public function certificate(Request $request)//实名认证
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

    public function risk_appraisal()//风险测评页
    {
        return view('user.risk_appraisal');
    }

    public function appraisal(Request $request)//风险测评
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

     public function security()//安全中心页
    {
        $security=0;
        $user=Auth::user()->get();
        if($user->mobile)
        {
            $security+=1;
        }
        if($user->ID_card)
        {
            $security+=1;
        }
        if($user->contact)
        {
            $security+=1;
        }
        switch ($security) {
            case '0':
                $security_level='极低';
                break;
            case '1':
                $security_level='低';
                break;
            case '2':
                $security_level='中';
                break;
            default:
                $security_level='高';
        }
        return view('user.security',['security_level'=>$security_level]);
    }

    public function mobile_binding(Request $request)
    {
        session_start();
        $this->validate($request, [
        'mobile' => 'required|digits:11',
        'verification_code' =>'required|digits:6'
        ]);
        $user=Auth::user()->get();
        if($request->verification_code==$_SESSION['verify_code'])
        {
            $user->mobile=$request->mobile;
            $user->save();
            Alert::success('恭喜你，手机号绑定成功！');
            return redirect()->back();
        }
        else
        {
            Alert::error('验证码输入有误，请重新输入！');
            return redirect()->back();
        }
    }

    public function contact_binding(Request $request)
    {
        $this->validate($request, [
        'contact' => 'required|digits:11',
        ]);
        $user=Auth::user()->get();
        $user->contact=$request->contact;
        $user->save();
        Alert::success('恭喜你，联系人设置成功！');
        return redirect()->back();
    }

    public function change_pwd(Request $request)
    {
        $this->validate($request,[
            'old_password'=>'required|min:6',
            'new_password'=>'required|confirmed|min:6'
            ]);
        $credentials=['username'=>Auth::user()->get()->username,'password'=>$request->old_password,];
        if(Auth::user()->attempt($credentials))
        {
            $user=Auth::user()->get();
            $user->password=bcrypt($request->new_password);
            $user->save();
            Alert::success('恭喜你，密码修改成功！');
            return redirect()->back();
        }
        else
        {
            Alert::error('抱歉，原密码输入不正确，请重新输入！');
            return redirect()->back();
        }
    }

    public function recharge()//充值页面
    {
        return view('user.recharge');
    }

    protected function email()  //邮件发送
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

    public function sms()
    {
        $statusStr = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
         );  
        $smsapi = "http://www.smsbao.com/"; //短信网关
        $user = "weiwei2018"; //短信平台帐号
        $pass = md5("w123456"); //短信平台密码
        $code=rand(100000,999999);
        Session_Start();
        $_SESSION["verify_code"]=$code;
        $content="【清风理财】验证码：".$code;//要发送的短信内容
        $phone = $_GET["mobile"];
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
        // echo $statusStr[$result];
    }

    public function is_idcard($id)  //身份证验证
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