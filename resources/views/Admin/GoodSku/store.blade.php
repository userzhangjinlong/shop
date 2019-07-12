@extends('layouts.admin-head')
@section('title', 'sku操作')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> sku管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>sku新增</li>
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
                            新增sku
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.goodsSkuCreate', [$id]) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group" id="add">
                                        <label for="cname" class="control-label col-lg-2">商品名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <select name="goods_id" id="goods_id" class="form-control m-bot15" onchange="getAttr()">
                                                <option value="">请选择商品</option>
                                                @foreach($goods_list as $v)
                                                    <option @if($sku_info && $sku_info->goods_id == $v->id) selected="true" @endif value="{{ $v->id }}">{{ $v->goods_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">描述内容</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="description"  value="{{ $sku_info ? $sku_info->description : '' }}"  id="" placeholder="请填写描述内容" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">价格</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="price"  value="{{ $sku_info ? $sku_info->price : '' }}"  id="" placeholder="请填写价格" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">库存量</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="stock"  value="{{ $sku_info ? $sku_info->stock : '' }}"  id="" placeholder="请填写库存量" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">是否默认 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="checkbox"  name="is_default" @if($sku_info && $sku_info->is_default == 1) checked="checked" @endif value="1">是否默认
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">属性图片 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="img" id="img">
                                            <p class="help-block">请上传缩略图在这儿</p>
                                            <img src="{{ $sku_info ? $sku_info->img : '' }}" width="40">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="hidden" id="skuId" name="id" value="{{ $sku_info ? $sku_info->id : '' }}">
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
        var id = $("#skuId").val();
        if (id){
            getAttr();
        }
        function getAttr() {
            $('.tt').remove();
            var goods_id = $('#goods_id option:selected').val();
            var str = '';
            $.ajax({
                url: "{{ route('admin.goodsAttribute') }}",
                type: 'post',
                dataType: 'json',
                data: {goods_id:goods_id, id:id, '_token':'{{ csrf_token() }}'},
                success: function(res){
                    if (res.code == 200){
                        var list = res.list;
                        for (var i=0; i< list.length; i++){
                            // var tmp_name = list[i].attr_val != undefined ? list[i].attr_val : '';
                            // var tmp_id = list[i].id != undefined ? list[i].id : '';
                            // var tmp_sku_id = list[i].sku_id != undefined ? list[i].sku_id : '';
                            str += '<div class="form-group tt">' +
                                '<label for="cname" class="control-label col-lg-2">'+list[i].name+'</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="attributes[]"  value="'+list[i].attr_val+'"  id="brand_desc" placeholder="输入'+list[i].name+'" />' +
                                '<input type="hidden" name="attributes_id[]" value="'+list[i].id+'" >'+
                                '<input type="hidden" name="sku_id[]" value="'+list[i].sku_id+'" >'+
                                '</div>' +
                                '</div>'
                        }
                        $("#add").after(str);
                    }else{
                        alert(res.msg);
                        return false;
                    }
                },
                error: function(){
                    alert('请求数据异常');
                }
            })
        }
    </script>
@endsection