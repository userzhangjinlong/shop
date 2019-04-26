<?php

namespace App\Http\Controllers\Admin;


use App\Http\Middleware\AuthAdmin;
use App\Models\Managers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


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
    public function __construct()
    {
//        $this->middleware('guest.admin')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        return  view('Admin.Auth.login');
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
        if (AuthAdmin::guard('admin')->attempt($this->validateUser($request->input()))) {
            $info = Managers::where('username', $request->username)->first();
            $request->session()->put('adminId', $info->id);
            $request->session()->put('userName', $request->username);
            return Redirect::to('admin/index');
//            ->with('success', '登录成功！')
        }else {
            return back()->with('error', '账号或密码错误')->withInput();
        }
    }

    /**
     * @return mixed
     */
    public function logout(){
        if(AuthAdmin::guard('admin')->user()){
            AuthAdmin::guard('admin')->logout();
        }
        return Redirect::to('admin/login');
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

    //验证用户字段
    protected function validateUser(array $data)
    {
        return [
            'username' => $data['username'],
            'password' => $data['password']
        ];
    }

}
