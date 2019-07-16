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
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.cateSearchValCreate', [$search_id, $id]) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">属性名</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control"  value="{{ $search_info->property_name }}"  placeholder="请填写筛选属性值" readonly/>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cate_id" value="{{ $id ? $data->cate_id : $search_info->cate_id }}">
                                    <input type="hidden" name="cate_name" value="{{ $id ? $data->cate_name : $search_info->cate_name }}">
                                    <input type="hidden" name="searchproperty_id" value="{{ $id ? $data->searchproperty_id : $search_id }}">
                                    <input type="hidden" name="searchproperty_name" value="{{ $id ? $data->searchproperty_name : $search_info->property_name }}">
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">属性值</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="searchproperty_value"  value="{{ $id ? $data->searchproperty_value : '' }}"  placeholder="请填写筛选属性值" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">搜索值</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="search_val"  value="{{ $id ? $data->search_val : '' }}"  placeholder="请填写筛选搜索值" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">排序</label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" name="sort"  value="{{ $id ? $data->sort : '' }}"  placeholder="请填写排序" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" name="id" value="{{ $id ? $id : '' }}">
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
            <!--列表开始-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            属性值列表
                        </header>

                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="icon_menu"></i> 属性值</th>
                                <th><i class="icon_menu"></i> 搜索值</th>
                                <th><i class="icon_menu"></i> 排序</th>
                                <th><i class="icon_cogs"></i> 操作</th>
                            </tr>
                            @if(!empty($list))
                                @foreach($list as $v)
                                    <tr>
                                        <td>{{ $v->searchproperty_value }}</td>
                                        <td>{{ $v->search_val }}</td>
                                        <td>{{ $v->sort }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-success" href="{{ route('admin.cateSearchValAdd', [$search_id,$v->id]) }}"><i class="icon_pencil-edit_alt"></i></a>
                                                <a class="btn btn-danger" data-toggle="modal" data-id="{{ $v->id }}" href="#del">
                                                    <i class="icon_close_alt2"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4"><p style="text-align: center;"><strong>暂无相关数据</strong></p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <!--列表开始-->
            <!-- Modal -->
            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-delid="0" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">删除属性值</h4>
                        </div>
                        <div class="modal-body">
                            你确认删除该属性值?
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                            <button class="btn btn-warning" onclick="del()" type="button"> 确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
        </section>
    </section>
    <script type="text/javascript">
        function del(){
            var id = $('#del').attr('data-delid');
            var url = '{{ url("admin/cateSearchValDel") }}'+'/'+id;
            window.location.href=url;
        }
    </script>
@endsection