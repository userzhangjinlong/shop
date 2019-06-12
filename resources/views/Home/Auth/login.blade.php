@extends('layouts.home-head')

@section('content')
    <div class="breadcrumb-area mt-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">首页 <i class="fa fa-angle-right"></i></a></li>
                            <li>登录</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($errors->any()))
        <div class="col-lg-7 alert alert-block alert-danger in" style="background-color:#ffffff;border: #ffffff; ">
            @foreach ($errors->all() as $error)
                <strong>* {{ $error }}</strong><br>
            @endforeach
        </div>
    @endif
    <div class="col-lg-7">
        <div class="contact-form mt-sm-30">
            <form id="contactForm" method="POST" action="{{ route('web.loginc') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <input type="phone" name="phone" placeholder="手机号码" id="phone" value="{{ old('phone') }}" />{{--style="width: 70%;"--}}
                        {{--<button id="yzm" type="button" onclick="getyzm(this)" style="width: 24%;margin-left: 3%;height: 38px;color: #ffffff;border: none;background: #e23e1c;line-height: 38px;">验证码</button>--}}
                    </div>
                    <div class="col-sm-12 mt-30">
                        <input type="password" name="password" placeholder="密码" id="password" value="{{ old('password') }}"/>
                    </div>
                    <div class="col-sm-12 mt-40">
                        <button class="btn-common" type="submit" id="form-submit">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection