<?php

namespace App\Http\Controllers\Home;

use App\Http\Middleware\GuestAuth;
use App\Rules\CheckMobile;
use App\User;
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
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        if (GuestAuth::guard('web')->attempt($this->validateUser($request->input()))) {
            $info = User::where('phone', $request->phone)->first();
            $request->session()->put('userInfo', $info);
            return Redirect::to('/index');
//            ->with('success', '登录成功！')
        }else {
            return back()->with('error', '账号或密码错误')->withInput();
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
            'phone'        =>      'required',
            'email'           =>      'required',
            'password'    =>      'required',
            'confirm_password'     =>      'required',
            'yzm'             =>      'required'
        ];

        $message = [
            'phone.required'                =>  '手机号码必填',
            'email.required'              =>  '邮箱必填',
            'password.required'       =>  '密码必填',
            'confirm_password.required'        =>  '确认密码必填',
            'yzm.required'            =>  '验证码必填'
        ];
        $validate = Validator::make($request->all(), $rule, $message);

        if (!$validate->passes()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $info = User::where('phone', $request->phone)->first();
        if (!empty($info)){
            return back()->withErrors('手机号码已被注册')->withInput();
        }

        $res = User::create([
            'phone'     =>  $request->phone,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password)
        ]);

        if ($res){
            $info = User::where('phone', $request->phone)->first();
            $request->session()->put('userInfo', $info);
            Redirect::to('/index');
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
        return Redirect::to('home/login');
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
        $key = 'captcha-'.$request->mobile;
        $expiredAt = now()->addMinutes(15);//15分钟后过期

        //将指定手机号码的验证码存入缓存 并载入过期时间
        Cache::put($key, $phar, $expiredAt);

        //这里写如第三方的短信发送监听器


        return response()->json(['code' => 200, 'msg' => 'ok']);
    }

}
