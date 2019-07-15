@extends('layouts.admin-head')
@section('title', '搜索属性操作')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 搜索属性管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>搜索属性新增</li>
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
                            新增搜索属性
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.cateSearchCreate', [$id]) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{--<div class="form-group" id="add">
                                        <label for="cname" class="control-label col-lg-2">商品名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <select name="cate_id" id="cate_id" class="form-control m-bot15" onchange="getCatename()">
                                                <option value="">请选择分类</option>
                                                @foreach($cate_list as $v)
                                                    <option @if($catesearch_info && $catesearch_info->cate_id == $v->id) selected="true" @endif value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="cate_name" id="cate_name" value="{{ $catesearch_info ? $catesearch_info->cate_name : '' }}">
                                    </div>--}}

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">分类名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <select name="cate_id" id="cate_id" class="form-control m-bot15" onchange="getCatename()">
                                                <option value="">请选择分类</option>
                                                @foreach($cate as $v)
                                                    <option @if($catesearch_info && $catesearch_info->cate_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cate_name" id="cate_name" value="{{ $catesearch_info ? $catesearch_info->cate_name : '' }}">

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">筛选属性名称</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="property_name"  value="{{ $catesearch_info ? $catesearch_info->property_name : '' }}"  id="" placeholder="请填写筛选属性名称" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">排序</label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" name="sort"  value="{{ $catesearch_info ? $catesearch_info->sort : 0 }}"  id="" placeholder="请填写排序" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" id="skuId" name="id" value="{{ $catesearch_info ? $catesearch_info->id : '' }}">
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

@section('script')
    <script type="text/javascript">
        function getCatename(){
            var name = $('#cate_id option:selected').text();
            $('#cate_name').val(name);
        }
    </script>
@endsection