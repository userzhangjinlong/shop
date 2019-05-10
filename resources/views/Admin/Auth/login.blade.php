@extends('layouts.admin-login')

@section('content')
<div class="container">

    <form class="login-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input id="email" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            @if (!empty(session('error')))
                <div class="alert alert-danger">
                    {{--<a class="close" data-dismiss="alert">×</a>--}}
                    <strong>{{ session('error') }}</strong>
                </div>
                </span>
            @endif

            <label class="checkbox">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">登录</button>
            </div>
            </form>
            <div class="text-right">
            <div class="credits">
            Designed by <a href="https://www.zhangjinlong-blog.cn/">zjl</a>
            </div>
            </div>

            </div>
@endsection

