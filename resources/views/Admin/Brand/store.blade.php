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
                                            <input type="text" class="form-control @if ($errors->has('brand_name')) error @endif" name="brand_name" @if ($brand_info) value="{{ $goods_info->brand_name }}" @endif id="brand_name" placeholder="请输入品牌名字" required />
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">品牌描述</label>
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
                                            <input type="checkbox" name="post_free" @if ($goods_info) @if ($goods_info->post_free ==0 || empty($goods_info->post_free)) checked="true" @endif @else checked="true" @endif value="0"> 是否包邮
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">邮费 </label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" name="postage" id="postage" @if ($goods_info) value="{{ $goods_info->postage ?: 0 }}" @endif placeholder="请输入邮费">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-2">满多少包邮费 </label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="full_price" @if ($goods_info) value="{{ $goods_info->full_price ?: 0 }}" @endif id="full_price" placeholder="满足金额减免邮费,0表示不减邮费">
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

    <script type="text/javascript">

    </script>
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
    </script>


@endsection