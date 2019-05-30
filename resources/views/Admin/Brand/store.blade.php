@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 品牌管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>品牌新增</li>
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
                            新增品牌
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.brandAdd', [$id]) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">品牌名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('brand_name')) error @endif" name="brand_name" @if ($brand_info) value="{{ $brand_info->brand_name }}" @endif id="brand_name" placeholder="请输入品牌名字" required />
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">品牌描述</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control error" name="brand_desc" @if ($brand_info) value="{{ $brand_info->brand_desc }}" @endif id="brand_desc" placeholder="请填写品牌描述" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">品牌缩略图 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="brand_img" id="brand_img">
                                            <p class="help-block">请上传缩略图在这儿</p>
                                            @if($brand_info && $brand_info->brand_img) <img src="{{ $brand_info->brand_img }}" width="40"> @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            @if($brand_info) <input type="hidden" name="id" value="{{ $brand_info->id }}"> @endif
                                            <button class="btn btn-primary" type="submit">提交</button>
                                            {{--<button class="btn btn-default" type="button">取消</button>--}}
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