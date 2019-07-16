@extends('layouts.admin-head')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="panel-body">
                    <div class="col-lg-12" style="text-align: center;">
                        <img src="/image/success.png">
                        <div class=" alert alert-success fade in " style="margin-top: 40px;">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="icon-remove"></i>
                            </button>
                            <strong>{{$message}}</strong>前往<a href="{{$url}}" style="color: #4cd964">{{$urlname}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script type="text/javascript">
        jiazai();
        function jiazai(){
            var url = "{{$url}}";
            var loginTime = "{{$jumpTime}}";
            var time = setInterval(function(){
                loginTime = loginTime-1;
                $('.loginTime').text(loginTime);
                if(loginTime==0){
                    clearInterval(time);
                    if(!url){
                        window.history.go(-1);
                    }
                    window.location.href=url;
                }
            },1000);
        }
    </script>
@endsection

