@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 分类管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>分类列表</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            分类列表
                        </header>

                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="icon_profile"></i> 名称</th>
                                <th><i class="icon_calendar"></i> 创建日期</th>
                                <th><i class="icon_mobile"></i> 排序</th>
                                <th><i class="icon_cogs"></i> 操作</th>
                            </tr>
                            @foreach($cateList as $v)
                            <tr>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td>{{ $v->sort }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="{{ route('admin.cateEdit', [$v->id]) }}"><i class="icon_pencil-edit_alt"></i></a>
                                        {{--<a class="btn btn-danger" href="javascript:if (confirm('确认删除?')) location.href='{{ route('admin.cateDel', [$v->id]) }}'"><i class="icon_close_alt2"></i></a>--}}
                                        <a class="btn btn-danger" data-toggle="modal" data-id="{{ $v->id }}" href="#del">
                                            <i class="icon_close_alt2"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-delid="0" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">删除分类</h4>
                        </div>
                        <div class="modal-body">
                            你确认删除该分类?
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                            <button class="btn btn-warning" onclick="del()" type="button"> 确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
            <!-- page end-->
        </section>
    </section>
    <script type="text/javascript">
        function del(){
            var id = $('#del').attr('data-delid');
            var url = '{{ url("admin/cateDel") }}'+'/'+id;
            window.location.href=url;
        }
    </script>
@endsection