<?php

namespace App\Http\Controllers\Home;

use App\Events\SendSms;
use App\Http\Middleware\GuestAuth;
use App\Rules\CheckMobile;
use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
////        $this->middleware('guest.admin')->except('logout');
//    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        return  view('Home.Auth.login');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request){
        $rule = [
            'phone'        =>      ['required', new CheckMobile],
            'password'    =>      'required|min:6',
        ];

        $message = [
            'phone.required'                =>  '手机号码必填',
            'password.required'       =>  '密码必填',
            'password.min'              =>  '密码不能小于6位数'
        ];
        $validate = Validator::make($request->all(), $rule, $message);

        if (!$validate->passes()) {
            return back()->withErrors($validate->errors())->withInput();
        }
//        $this->validate($request, [
//            $this->username() => 'required|string',
//            'password' => 'required|string',
//        ]);
        if (GuestAuth::guard('web')->attempt($this->validateUser($request->input()))) {
            $info = User::where('phone', $request->phone)->first();
            $request->session()->put('userInfo', $info);
            session()->flash('success', '登录成功');
            return redirect()->route('web.index');
        }else {
            return back()->withErrors('账号或密码错误')->withInput();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterForm(){
        return  view('Home.Auth.register');
    }

    public function register(Request $request){
        $rule = [
            'phone'        =>      ['required', new CheckMobile, 'unique:users'],
            'email'           =>      'required',
            'password'    =>      'required|min:6',
            'confirm_password'     =>      'required',
            'yzm'             =>      'required'
        ];

        $message = [
            'phone.required'                =>  '手机号码必填',
            'phone.unique'              =>  '手机号码已经被注册啦',
            'email.required'              =>  '邮箱必填',
            'password.required'       =>  '密码必填',
            'password.min'              =>  '密码不能小于6位数',
            'confirm_password.required'        =>  '确认密码必填',
            'yzm.required'            =>  '验证码必填'
        ];
        $validate = Validator::make($request->all(), $rule, $message);

        if (!$validate->passes()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $key = 'captcha-'.$request->phone;
        if (empty(Cache::get($key))){
            return back()->withErrors('验证码已过期')->withInput();
        }
        if ($request->yzm != Cache::get($key)){
            return back()->withErrors('验证码错误')->withInput();
        }

        if ($request->password != $request->confirm_password){
            return back()->withErrors('两次输入的密码不一致')->withInput();
        }

        $res = User::create([
            'phone'     =>  $request->phone,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password)
        ]);

        if ($res){
            $info = User::where('phone', $request->phone)->first();
            $request->session()->put('userInfo', $info);
            session()->flash('success', '注册成功');
            return redirect()->route('web.index');
        }else{
            return back()->withErrors('登录失败,请重试')->withInput();
        }

    }

    /**
     * @return mixed
     */
    public function logout(){
        if(GuestAuth::guard('web')->user()){
            GuestAuth::guard('web')->logout();
        }
        session()->flash('success', '退出成功');
        return redirect()->route('web.index');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * 验证用户登录字段
     *
     * @param array $data
     * @return array
     */
    protected function validateUser(array $data)
    {
        return [
            'phone' => $data['phone'],
            'password' => $data['password']
        ];
    }


    public function yzm(Request $request){
        $rule = [
            'phone'        =>      ['required', new CheckMobile, 'unique:users']
        ];

        $message = [
            'phone.required'                =>  '手机号码必填',
            'phone.unique'              =>  '手机号码已经被注册啦'
        ];
        $validate = Validator::make($request->all(), $rule, $message);

        if (!$validate->passes()) {
            return response()->json(['code' => 400, 'msg' => $validate->errors()]);
        }
        $phar = new PhraseBuilder(5, '0123456789');
        $captchaBuilder = new CaptchaBuilder(null, $phar);
        $captcha = $captchaBuilder->build();//创建验证码图片
        $key = 'captcha-'.$request->phone;
        $expiredAt = now()->addMinutes(15);//15分钟后过期

        //将指定手机号码的验证码存入缓存 并载入过期时间
        Cache::put($key, $captcha->getPhrase(), $expiredAt);

        //分发发送短信时间 监听器
        event(new SendSms($request->phone, $captcha->getPhrase()));

        return response()->json(['code' => 200, 'msg' => 'ok']);
    }

}
