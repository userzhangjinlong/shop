@extends('layouts.admin-head')
@section('title', '新增商品')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> 商品管理</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/admin/">首页</a></li>
                        <li><i class="icon_document_alt"></i>商品新增</li>
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
                            新增商品
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form method="POST" class="form-validate form-horizontal" id="feedback_form"  action="{{ route('admin.goodsAdd', [$id]) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('goods_name')) error @endif" name="goods_name" @if ($goods_info) value="{{ $goods_info->goods_name }}" @endif id="name" placeholder="请输入商品名字" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">分类名称 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                        <select name="cate_id" class="form-control m-bot15">
                                            <option value="">请选择分类</option>
                                            @foreach($cate as $v)
                                                <option @if($goods_info && $goods_info->cate_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">品牌名称</label>
                                        <div class="col-lg-10">
                                            <select name="brand_id" class="form-control m-bot15">
                                                <option value="0">无品牌</option>
                                                @foreach($brand as $v)
                                                    <option @if($goods_info && $goods_info->brand_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">商品描述</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control error" name="desc" @if ($goods_info) value="{{ $goods_info->desc }}" @endif id="desc" placeholder="请填写分类描述" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品标签</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="tags" @if ($goods_info) value="{{ $goods_info->tags }}" @endif id="tags" placeholder="多个标签请以英文','符号分割例入:测试1,测试2">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品原价 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('original_price')) error @endif" name="original_price" @if ($goods_info) value="{{ $goods_info->original_price }}" @endif id="original_price" placeholder="请输入商品原价" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品售价 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('present_price')) error @endif" name="present_price" @if ($goods_info) value="{{ $goods_info->present_price }}" @endif id="present_price" placeholder="请输入商品售价" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品缩略图 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="thumb_img" id="thumb_img">
                                            <p class="help-block">请上传缩略图在这儿</p>
                                            @if($goods_info && $goods_info->thumb_img) <img src="{{ $goods_info->thumb_img }}" width="40"> @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品轮播多图 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="carousel_img[]" id="carousel_img" multiple/>
                                            <p class="help-block">请上传轮播多图在这儿</p>
                                            @if($goods_info && $goods_info->carousel_img)
                                                @foreach($goods_info->carousel_img as $img)
                                                    <img src="{{ $img }}" width="40">
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品库存 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('stock')) error @endif" name="stock" @if ($goods_info) value="{{ $goods_info->stock }}" @endif id="stock" placeholder="请输入商品库存" required />
                                        </div>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">包邮选择 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" onclick="isbaoyou()" id="post_free" name="post_free" @if ($goods_info) @if ($goods_info->post_free ==0 || empty($goods_info->post_free)) checked="true" @endif @else checked="true" @endif value="0"> 是否包邮
                                        </div>
                                    </div>
                                    <div class="form-group" id="postagediv">
                                        <label for="cname" class="control-label col-lg-2">邮费 </label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="postage" id="postage" @if ($goods_info) value="{{ $goods_info->postage ?: 0 }}" @endif placeholder="请输入邮费">
                                        </div>
                                    </div>
                                    <div class="form-group" id="full_pricediv">
                                        <label for="cname" class="control-label col-lg-2">满多少包邮费 </label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="full_price" @if ($goods_info) value="{{ $goods_info->full_price ?: 0 }}" @endif id="full_price" placeholder="满足金额减免邮费,0表示不减邮费">
                                        </div>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">是否上架 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" id="sales" name="sales" @if ($goods_info) @if ($goods_info->sales ==0 || empty($goods_info->sales)) checked="true" @endif @else checked="true" @endif value="0"> 是否上架
                                        </div>
                                    </div>


                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">是否热销 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" id="hot" name="hot" @if ($goods_info) @if ($goods_info->hot ==1) checked="true" @endif @endif value="1"> 是否热销
                                        </div>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">是否精品 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" id="best_good" name="best_good" @if ($goods_info) @if ($goods_info->best_good ==1) checked="true" @endif @endif value="1"> 是否精品
                                        </div>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">是否开启秒杀活动 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" onclick="isspike()" id="spike" name="spike" @if ($goods_info) @if ($goods_info->spike ==1) checked="true" @endif @endif value="1"> 是否开启秒杀
                                        </div>
                                    </div>

                                    <div class="form-group" id="spike_pricediv">
                                        <label for="cname" class="control-label col-lg-2">秒杀价格 </label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="spike_price" @if ($goods_info) value="{{ $goods_info->spike_price ?: 0 }}" @endif id="spike_price" placeholder="商品秒杀活动开启的价格">
                                        </div>
                                    </div>

                                    <div class="form-group" id="spike_b_timediv">
                                        <label for="cname" class="control-label col-lg-2">秒杀开始时间 </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"  name="spike_b_time" @if ($goods_info) value="{{ $goods_info->spike_b_time}}" @endif id="spike_b_time" placeholder="请选择秒杀活动结束时间">
                                        </div>
                                    </div>

                                    <div class="form-group" id="spike_e_timediv">
                                        <label for="cname" class="control-label col-lg-2">秒杀结束时间 </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="spike_e_time" @if ($goods_info) value="{{ $goods_info->spike_e_time}}" @endif id="spike_e_time" placeholder="请选择秒杀活动结束时间">
                                        </div>
                                    </div>

                                    <div class="form-group checkbox">
                                        <label for="cname" class="control-label col-lg-2">是否发起拼团 </label>
                                        <div class="col-lg-10">
                                            <input type="checkbox" onclick="ispintuan()" id="group_buy" name="group_buy" @if ($goods_info) @if ($goods_info->group_buy ==1) checked="true" @endif @endif value="1"> 是否开启拼团
                                        </div>
                                    </div>

                                    <div class="form-group" id="broup_buy_numdiv">
                                        <label for="cname" class="control-label col-lg-2">拼团人数 </label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="broup_buy_num" id="broup_buy_num" @if ($goods_info) value="{{ $goods_info->broup_buy_num ?: 0 }}" @endif placeholder="请输入参与拼团人数">
                                        </div>
                                    </div>

                                    <div class="form-group" id="group_buy_pricediv">
                                        <label for="cname" class="control-label col-lg-2">拼团价格 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('group_buy_price')) error @endif" name="group_buy_price" @if ($goods_info) value="{{ $goods_info->group_buy_price }}" @endif id="group_buy_price" placeholder="请输入拼团价格" />
                                        </div>
                                    </div>

                                    <div class="form-group" id="group_buy_s_pricediv">
                                        <label for="cname" class="control-label col-lg-2">拼团发起价格 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control @if ($errors->has('group_buy_s_price')) error @endif" name="group_buy_s_price" @if ($goods_info) value="{{ $goods_info->group_buy_s_price }}" @endif id="group_buy_s_price" placeholder="请输入发起拼团价格" />
                                        </div>
                                    </div>


                                    <!-- CKEditor -->
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">保障信息 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <textarea id="editor" name="ensure">@if ($goods_info) {{ $goods_info->ensure }} @endif</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">商品详情 <span class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <textarea id="editor1" name="goods_detail">@if ($goods_info) {{ $goods_info->goods_detail }} @endif</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group addhtml">
                                        <label for="cname" class="control-label col-lg-2">商品属性</label>
                                        <button class="btn btn-success" type="button" onclick="addattribute()" >新增属性</button>
                                    </div>

                                    <!--商品属性s-->
                                    @if(!empty($attributeList))
                                     @foreach($attributeList as $item)
                                        <div class="addhtml">
                                            <div class="form-group" >
                                                <label for="cname" class="control-label col-lg-2">属性名称 <span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" value="{{ $item->name }}" name="attr_name[]" placeholder="属性名称" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname" class="control-label col-lg-2">是否可选 <span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                    <select name="hasmany[]" class="form-control m-bot15">
                                                        <option @if($item->hasmany == 1) selected="true" @endif value="1">可选</option>
                                                        <option @if($item->hasmany == 0) selected="true" @endif value="0">不可选</option>
                                                    </select>
                                                    <font color="red">不可选时表示商品唯一属性列入：手机品牌、型号、入网型号、材质系统等；可选属性标示前台可选择价格变动：列如手机颜色、内存大小等</font>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname" class="control-label col-lg-2">属性值</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" value="{{ $item->attr_val ?: '' }}" name="attr_val[]" placeholder="属性值" />
                                                    <input type="hidden" name="attr_id[]" value="{{ $item->id }}">
                                                    <font color="red">不可选时填写标示不可选唯一属性的值列如：手机品牌：华为</font>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname" class="control-label col-lg-2">顺序 <span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="number" class="form-control" value="{{ $item->sort }}" name="attr_sort[]" placeholder="顺序" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10" style="text-align: center">
                                                    <input type="button" class="btn btn-danger" onclick="delrealattr(this, {{ $item->id }})" value="删除">
                                                </div>
                                            </div>
                                        </div>
                                     @endforeach
                                    @endif
                                    <!--商品属性e-->


                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            @if($goods_info) <input type="hidden" name="id" value="{{ $goods_info->id }}"> @endif
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
    <!-- bootstrap-wysiwyg -->
    <script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('js/bootstrap-wysiwyg.js') }}"></script>
    <script src="{{ asset('js/bootstrap-wysiwyg-custom.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- ck editor -->
    <script type="text/javascript" src="{{ asset('js/assets/ckeditor/ckeditor.js') }}"></script>

    <script>
        isbaoyou();
        ispintuan();
        isspike();
        $('#spike_b_time').datepicker();
        $('#spike_e_time').datepicker();
        {{--CKEDITOR.editorConfig = function(config) {--}}
            {{--// config.language = 'fr';--}}
            {{--// config.uiColor = '#AADC6E';--}}
            {{--config.image_previewText = '';--}}
            {{--config.removeDialogTabs = 'image:advanced;image:Link';//隐藏超链接与高级选项--}}
            {{--config.filebrowserImageUploadUrl = "{{ route('admin.uploaddditorimage', 'GoodsDetail') }}";//上传图片的地址--}}
            {{--config.filebrowserImageUploadUrl = "{{ route('admin.uploaddditorimage', 'GoodsDetail') }}";//上传图片的地址--}}
        {{--};--}}
        CKEDITOR.replace("editor", {
            height:'400px',
            language : 'zh-cn',
            filebrowserImageUploadUrl : "{{ route('admin.uploaddditorimage', 'GoodsDetail') }}",//上传图片的地址

        });
        CKEDITOR.replace("editor1", {
            height:'400px',
            language : 'zh-cn',
            filebrowserImageUploadUrl : "{{ route('admin.uploaddditorimage', 'GoodsDetail') }}",//上传图片的地址
        });

        function isbaoyou() {
            if ($("#post_free").is(":checked")){
                //包邮
                $('#postage').val(0);
                $('#postagediv').hide();
                $('#full_price').val(0);
                $('#full_pricediv').hide();
            }else{
                $('#postagediv').show();
                $('#full_pricediv').show();
            }
        }

        function ispintuan() {
            if ($("#group_buy").is(":checked")){
                //开启拼团
                $('#broup_buy_numdiv').show();
                $('#group_buy_pricediv').show();
                $('#group_buy_s_pricediv').show();
            }else{
                $('#broup_buy_numdiv').hide();
                $('#group_buy_pricediv').hide();
                $('#group_buy_s_pricediv').hide();
            }
        }

        function isspike() {
            if ($("#spike").is(":checked")){
                //开启秒杀
                $('#spike_pricediv').show();
                $('#spike_b_timediv').show();
                $('#spike_e_timediv').show();
            }else{
                $('#spike_pricediv').hide();
                $('#spike_b_timediv').hide();
                $('#spike_e_timediv').hide();
            }
        }

        function addattribute(){
            var str = '<div class="addhtml"><div class="form-group" >' +
                '<label for="cname" class="control-label col-lg-2">属性名称 <span class="required">*</span></label>' +
                '<div class="col-lg-10">' +
                '<input type="text" class="form-control" name="attr_name[]" placeholder="属性名称" />' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="cname" class="control-label col-lg-2">是否可选 <span class="required">*</span></label>' +
                '<div class="col-lg-10">' +
                '<select name="hasmany[]" class="form-control m-bot15">' +
                '<option value="1">可选</option>' +
                '<option value="0">不可选</option>' +
                '</select>' +
                '<font color="red">不可选时表示商品唯一属性列入：手机品牌、型号、入网型号、材质系统等；可选属性标示前台可选择价格变动：列如手机颜色、内存大小等</font>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="cname" class="control-label col-lg-2">属性值</label>' +
                '<div class="col-lg-10">' +
                '<input type="text" class="form-control" name="attr_val[]" placeholder="属性值" />' +
                '<input type="hidden" name="attr_id[]" >' +
                '<font color="red">不可选时填写标示不可选唯一属性的值列如：手机品牌：华为</font>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="cname" class="control-label col-lg-2">顺序 <span class="required">*</span></label>' +
                '<div class="col-lg-10">' +
                '<input type="number" class="form-control" name="attr_sort[]" placeholder="顺序" />' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<div class="col-lg-offset-2 col-lg-10" style="text-align: center">' +
                '<input type="button" class="btn btn-danger" onclick="deldiv(this)" value="删除">' +
                '</div>' +
                '</div></div>';

            $(".addhtml:last").after(str);
        }

        //删除属性htmldiv
        function deldiv(obj) {
            $(obj).parents('.addhtml').html('');
        }

        //删除真实属性数据
        function delrealattr(obj, attr_id) {
            $.ajax({
                url: "{{ route('admin.delAttr') }}",
                type: 'post',
                dataType: 'json',
                data: {attr_id:attr_id, '_token':'{{ csrf_token() }}'},
                success: function(res){
                    if (res.code == 200){
                        $(obj).parents('.addhtml').html('');
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