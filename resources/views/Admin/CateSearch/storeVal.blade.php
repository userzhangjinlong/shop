@extends('layouts.admin-head')
@section('title', '搜索属性值操作')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 搜索属性管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>搜索属性值新增</li>
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
                            新增搜索属性值
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.cateSearchValCreate', [$search_id]) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">属性名</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control"  value="{{ $search_info->property_name }}"  placeholder="请填写筛选属性值" readonly/>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cate_id" value="{{ $search_info->cate_id }}">
                                    <input type="hidden" name="cate_name" value="{{ $search_info->cate_name }}">
                                    <input type="hidden" name="searchproperty_id" value="{{ $search_id }}">
                                    <input type="hidden" name="searchproperty_name" value="{{ $search_info->property_name }}">
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">属性值</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="searchproperty_value"  value=""  placeholder="请填写筛选属性值" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">搜索值</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="search_val"  value=""  placeholder="请填写筛选搜索值" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">排序</label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" name="sort"  value=""  id="" placeholder="请填写排序" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            {{--<input type="hidden" id="skuId" name="id" value="{{ $catesearch_info ? $catesearch_info->id : '' }}">--}}
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