@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> banner管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>banner新增</li>
                    </ol>
                </div>
            </div>
            @if(!empty($errors->any()))
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    @foreach ($errors->all() as $error)
                        <strong>* {{ $error }}</strong><br>
                    @endforeach
                </div>
            @endif
            <!--  page start -->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            新增banner
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.bannerAdd', [$id]) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">banner名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('banner_name')) error @endif" name="banner_name" @if ($banner_info) value="{{ $banner_info->banner_name }}" @endif id="banner_name" placeholder="请输入广告图名字" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">广告位 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <select name="adver_id" class="form-control m-bot15">
                                                <option value="">请选择广告位</option>
                                                @foreach($adver_list as $v)
                                                    <option @if($banner_info && $banner_info->adver_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->adver_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">banner描述</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control error" name="banner_desc" @if ($banner_info) value="{{ $banner_info->banner_desc }}" @endif id="banner_desc" placeholder="请填写广告图描述" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">广告图片 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="banner_img" id="banner_img">
                                            <p class="help-block">请上传缩略图在这儿</p>
                                            @if($banner_info && $banner_info->banner_img) <img src="{{ $banner_info->banner_img }}" width="40"> @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            @if($banner_info) <input type="hidden" name="id" value="{{ $banner_info->id }}"> @endif
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection