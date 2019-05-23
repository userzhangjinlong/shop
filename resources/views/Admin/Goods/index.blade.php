@extends('layouts.admin-head')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 商品管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>商品列表</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            商品列表
                        </header>

                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="icon_menu"></i> 名称</th>
                                <th><i class="icon_menu"></i> 分类名称</th>
                                <th><i class="icon_calendar"></i> 创建日期</th>
                                <th><i class="icon_laptop"></i> 排序</th>
                                <th><i class="icon_cogs"></i> 操作</th>
                            </tr>
                            @if(!empty($list))
                                @foreach($list as $v)
                                <tr>
                                    <td>{{ $v->goods_name }}</td>
                                    <td>{{ $v->category->name }}</td>
                                    <td>{{ $v->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="{{ route('admin.goodsAdd', [$v->id]) }}"><i class="icon_pencil-edit_alt"></i></a>
                                            {{--<a class="btn btn-danger" href="javascript:if (confirm('确认删除?')) location.href='{{ route('admin.cateDel', [$v->id]) }}'"><i class="icon_close_alt2"></i></a>--}}
                                            <a class="btn btn-danger" data-toggle="modal" data-id="" href="#del">
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
            <!-- Modal -->
            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-delid="0" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">删除商品</h4>
                        </div>
                        <div class="modal-body">
                            你确认删除该商品??
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
    {{--<script type="text/javascript">--}}
        {{--function del(){--}}
            {{--var id = $('#del').attr('data-delid');--}}
            {{--var url = '{{ url("admin/cateDel") }}'+'/'+id;--}}
            {{--window.location.href=url;--}}
        {{--}--}}

        {{--function changeSort(id, obj) {--}}
            {{--// var num = $(obj).find('input[name="sort"]').val();--}}
            {{--var num = $(obj).val();--}}

            {{--$.ajax({--}}
                {{--type: "Post",--}}
                {{--url: "{{ route('admin.cateSort') }}", //请求地址--}}
                {{--data: {'id':id,'num':num, '_token':'{{ csrf_token() }}' },--}}
                {{--dataType:"JSON",--}}
                {{--success: function(data) {--}}
                    {{--if(data.code == 400){--}}
                        {{--alert(data.msg);--}}
                    {{--}--}}
                {{--},--}}
                {{--error: function(err) {--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

    {{--</script>--}}
@endsection