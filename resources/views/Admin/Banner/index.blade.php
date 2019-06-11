@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> banner管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>banner列表</li>
                    </ol>
                </div>
            </div>

            <div class="container">

                <form action="{{ route('admin.bannerList') }}" method="get">
                    <div class="col-lg-3">
                        <label>筛选:</label>
                        <input type="text" name="keywords" value="{{ $keywords }}" class="form-control input-lg">
                    </div>
                    <div class="input-group">
                        <button class="btn btn-primary" type="submit"><i class="icon_search"></i></button>
                    </div>
                </form>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            banner列表
                        </header>

                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="icon_menu"></i> 名称</th>
                                <th><i class="icon_menu"></i> 广告位</th>
                                <th><i class="icon_calendar"></i> 创建日期</th>
                                <th><i class="icon_cogs"></i> 操作</th>
                            </tr>
                            @if(!empty($list))
                                @foreach($list as $v)
                                    <tr>
                                        <td>{{ $v->banner_name }}</td>
                                        <td>{{ $v->adver->adver_name }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-success" href="{{ route('admin.bannerAdd', [$v->id]) }}"><i class="icon_pencil-edit_alt"></i></a>
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
                        <div class="text-center">
                            {{ $list->links() }}
                        </div>
                    </section>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-delid="0" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">删除banner</h4>
                        </div>
                        <div class="modal-body">
                            你确认删除该banner?
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
            var url = '{{ url("admin.bannerDel") }}'+'/'+id;
            window.location.href=url;
        }
    </script>
@endsection