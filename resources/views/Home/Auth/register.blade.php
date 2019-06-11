@extends('layouts.home-head')

@section('content')
    <div class="breadcrumb-area mt-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">首页 <i class="fa fa-angle-right"></i></a></li>
                            <li>注册</li>
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
            <form id="contactForm" method="POST" action="{{ route('web.register') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <input type="phone" name="phone" placeholder="手机号码" id="phone" value="{{ old('phone') }}" style="width: 70%;"/>
                        <button id="yzm" type="button" onclick="getyzm(this)" style="width: 24%;margin-left: 3%;height: 38px;color: #ffffff;border: none;background: #e23e1c;line-height: 38px;">验证码</button>
                    </div>
                    <div class="col-sm-12 mt-30">
                        <input type="text" name="yzm" placeholder="验证码"  value="{{ old('yzm') }}"/>
                    </div>
                    <div class="col-sm-12 mt-30">
                        <input type="email" name="email" placeholder="邮箱" id="email" value="{{ old('email') }}"/>
                    </div>
                    <div class="col-sm-12 mt-30">
                        <input type="password" name="password" placeholder="密码" id="password" value="{{ old('password') }}"/>
                    </div>
                    <div class="col-sm-12 mt-30">
                        <input type="password" name="confirm_password" placeholder="确认密码" id="confirm_password" value="{{ old('confirm_password') }}"/>
                    </div>
                    <div class="col-sm-12 mt-40">
                        <button class="btn-common" type="submit" id="form-submit">注册</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function getyzm(obj){
            var phone = $('#phone').val();
            $.ajax({
                type: "Post",
                url: "{{ route('web.yzm') }}", //请求地址
                data: {'phone':phone, '_token':'{{ csrf_token() }}' },
                dataType:"JSON",
                success: function(data) {
                    if(data.code == 400){
                        alert(data.msg.phone[0]);
                        return false;
                    }
                },
                error: function(err) {
                }
            });
        }

    </script>
@endsection