@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 分类管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>分类新增</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            新增/编辑 分类
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('cateAdd') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">分类名称</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入分类名字" >
                                    @if ($errors->has('name'))
                                        <div class="alert alert-success">
                                            <a class="close" data-dismiss="alert">×</a>
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">父分类</label>
                                    <select name="pid" class="form-control input-lg m-bot15">
                                        <option value="0">|- 一级分类</option>
                                        @foreach($cateList as $v)
                                                <option value="{{ $v->id }}">| {{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">分类描述</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="请填写分类描述">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">图标</label>
                                    <input type="file" name="cateicon" id="cateicon">
                                    <p class="help-block">请上传分类图标在这儿</p>
                                </div>
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </form>

                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <script type="text/javascript">

    </script>
@endsection