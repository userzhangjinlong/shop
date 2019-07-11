@extends('layouts.home-head')

@section('content')
    <style>
        .item{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 5px;
            width: 100%;
            position: relative;
        }
        .top li{
            list-style: none;
            float: left;
            width: 25%;
            text-align: center;
        }
        .checked{
            background: #e23e1d;
        }
        .checked a{
            color: #ffffff;
        }
    </style>
    <div class="sticker mobile-header top">
        <li class="checked"><a href="{{ route('web.goodslist', [$cate_id])}}" class="item has J_ping " ><span>默认<i class="icon_tri"></i></span></a></li>
        <li><a href="{{ route('web.goodslist', [$cate_id, 'sales', $order])}}" class="item J_ping">销量</a></li>
        <li><a href="{{ route('web.goodslist', [$cate_id, 'price', $order])}}" class="item hide">价格</a></li>
        <li><a href="javascript:" class="item btn_sf J_ping" id="filterBtn" >筛选</a></li>
    </div>
    <div style="clear: both;"></div>
    <div class="shop-area" style="padding-top: 0">
        <div class="container-fluid">
            <div class="row">
                {{--<div class="col-xl-2 col-lg-3">
                    <div class="sidebar">
                        <div class="price_filter mt-40">
                            <div class="section-title"><h3>价格区间</h3></div>
                            <div class="price_slider_amount">
                                <div class="row align-items-center">
                                    <div class="col-lg-6"><input type="text" id="amount" name="price"
                                                                 placeholder="Add Your Price"/></div>
                                    <div class="col-lg-6">
                                        <button>Filter</button>
                                    </div>
                                </div>
                            </div>
                            <div id="slider-range"></div>
                        </div>
                        <div class="list-filter mt-43">
                            <div class="section-title"><h3>品牌</h3></div>
                            <ul class="list-none mt-25">
                                <li><input type="checkbox" id="acer"/><label for="acer">Acer</label></li>
                                <li><input type="checkbox" id="apple"/><label for="apple">Apple</label></li>
                                <li><input type="checkbox" id="asus"/><label for="asus">Asus</label></li>
                                <li><input type="checkbox" id="gionee"/><label for="gionee">Gionee</label></li>
                                <li><input type="checkbox" id="htc"/><label for="htc">HTC</label></li>
                                <li><a href="#">+ Show more</a></li>
                            </ul>
                        </div>
                        <div class="list-filter mt-43">
                            <div class="section-title"><h3>颜色</h3></div>
                            <ul class="list-none mt-25">
                                <li><input type="checkbox" id="black"/><label for="black">Black</label></li>
                                <li><input type="checkbox" id="pink"/><label for="pink">Pink</label></li>
                                <li><input type="checkbox" id="white"/><label for="white">White</label></li>
                                <li><input type="checkbox" id="blue"/><label for="blue">Blue</label></li>
                                <li><input type="checkbox" id="orange"/><label for="orange">Orange</label></li>
                                <li><a href="#">+ Show more</a></li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
                <div class="col-xl-10 col-lg-9">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-6">
                            {{--<div class="products-sort">
                                <form><select name="sort">
                                        <option value="0">默认</option>
                                        <option value="1">销量低-高</option>
                                        <option value="4">销量高-低</option>
                                        <option value="2">价格低-高</option>
                                        <option value="3">价格高-低</option>
                                    </select></form>
                            </div>--}}
                            {{--<div class="products-sort">--}}
                                {{--<form><label>Show :</label><select>--}}
                                        {{--<option>12</option>--}}
                                        {{--<option>8</option>--}}
                                        {{--<option>4</option>--}}
                                    {{--</select></form>--}}
                            {{--</div>--}}
                        </div>
                        <div class="col-lg-5 col-md-12">
                            {{--<div class="site-pagination pull-right">
                                <ul>
                                    <li><a href="#" class="active">1</a></li>
                                    <li>of</li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                </ul>
                            </div>--}}
                            <div class="product-view-system pull-right" role="tablist">
                                <ul class="nav nav-tabs">
                                    <li><a class="active" data-toggle="tab" href="#grid-products"><img
                                                    src="{{ asset('home/images/icons/icon-grid.png') }}" alt=""/></a></li>
                                    <li><a data-toggle="tab" href="#list-products"><img
                                                    src="{{ asset('home/images/icons/icon-list.png') }}" alt=""/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="grid-products" class="tab-pane active">
                            <div class="row">
                                @foreach($list as $v)
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="product-single">
                                        <div class="product-title">
                                            <small><a href="{{ route('web.goodsdetail',[$v->id]) }}">{{ $v->goods_name }}</a></small>
                                            <h4><a href="{{ route('web.goodsdetail',[$v->id]) }}">{{ $v->desc }}</a></h4>
                                        </div>
                                        <div class="product-thumb"><a href="{{ route('web.goodsdetail',[$v->id]) }}"><img src="{{ $v->thumb_img }}"
                                                                                    alt=""/></a>
                                            <div class="product-quick-view"><a href="{{ route('web.goodsdetail',[$v->id]) }}" data-toggle="modal" data-target="#quick-view">查看详情</a>
                                            </div>
                                        </div>
                                        <div class="product-price-rating">
                                            <div class="pull-left"><span>￥{{ $v->present_price }}</span></div>
                                            <div class="pull-right"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i
                                                        class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i
                                                        class="fa fa-star-o"></i><span class="rating-quantity">({{ $v->sale_num }})</span></div>
                                        </div>
                                        <div class="product-action"><a href="javascript:void(0);" class="product-compare"><i
                                                        class="ti-control-shuffle"></i></a><a href="javascript:void(0);"
                                                                                              class="add-to-cart">+</a><a
                                                    href="javascript:void(0);" class="product-wishlist"><i class="ti-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="list-products" class="tab-pane">
                            @foreach($list as $v)
                            <div class="product-single wide-style">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="product-thumb"><a href="{{ route('web.goodsdetail',[$v->id]) }}"><img src="{{ $v->thumb_img }}" alt=""/></a>
                                            <div class="product-quick-view"><a href="{{ route('web.goodsdetail',[$v->id]) }}" data-toggle="modal" data-target="#quick-view">查看详情</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-8 product-desc mt-md-50 sm-mt-50"><a href="#" class="add-to-wishlist"><i
                                                    class="icon_heart_alt"></i></a>
                                        <div class="product-title">
                                            <small><a href="{{ route('web.goodsdetail',[$v->id]) }}">{{ $v->goods_name }}</a></small>
                                            <h4><a href="{{ route('web.goodsdetail',[$v->id]) }}">{{ $v->desc }}</a></h4></div>
                                        <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star-o"></i><span>({{ $v->sale_num }})</span></div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-4">
                                        <div class="product-action stuck">
                                            <div class="free-delivery"><a href="#"><i class="ti-truck"></i>Free Delivery</a>
                                            </div>
                                            <div class="product-price-rating">
                                                <del>{{ $v->original_price }}</del>
                                                <span>￥{{ $v->present_price }}</span></div>
                                            <div class="product-stock"><p>Avability: <span>In stock</span></p></div>
                                            <a href="#" class="add-to-cart">Add to Cart</a><a href="#"
                                                                                              class="add-to-cart compare">+
                                                ADD to Compare</a></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row align-items-center mt-30">
                        <div class="col-lg-6">
                            <div class="site-pagination">
                                {{ $list->render() }}
                                {{--<ul>--}}
                                    {{--<li><a href="#" class="active">1</a></li>--}}
                                    {{--<li>of</li>--}}
                                    {{--<li><a href="#">3</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-long-arrow-right"></i></a></li>--}}
                                {{--</ul>--}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div><!--products-area end-->
        <style>
            .sf_layer_con{
                overflow: hidden;
                overflow-y: auto;
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10000;
                padding-bottom: 50px;
                background-color: #f7f7f7;
            }
            .mod_list{
                margin-bottom: 15px;
                background-color: #fff;
            }
            .mod_list li.super_li.no_arrow {
                padding-right: 13px;
            }
            .mod_list .filterlayer_price {
                position: relative;
            }
            .mod_list li {
                position: relative;
                line-height: 25px;
                padding: 10px;
                list-style: none;
            }
            .mod_list .li_line {
                display: flex;
            }
            .mod_list .li_line .big {
                height: 25px;
                max-width: 250px;
                overflow: hidden;
                font-size: 16px;
                color: #333;
                text-overflow: ellipsis;
            }
            .mod_list .li_line .right {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                -webkit-box-flex: 1;
                flex: 1;
                margin-left: 5px;
                text-align: right;
                font-size: 12px;
                color: #999;
            }
            .words_10 {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                display: inline-block;
                vertical-align: middle;
                text-align: right;
                max-width: 242px;
            }
            .mod_list .filterlayer_price .filterlayer_price_area {
                display: flex;
            }
            .mod_list .filterlayer_price .filterlayer_price_area_input {
                padding: 10px;
                border: 0;
                -webkit-box-flex: 1;
                -webkit-flex: 1;
                flex: 1;
                width: 100%;
                -webkit-appearance: none;
                appearance: none;
                text-align: center;
                border-radius: 3px;
                font-size: 14px;
                color: #333;
                background-color: #f7f7f7;
            }
            .mod_list .filterlayer_price .filterlayer_price_area_hyphen {
                position: relative;
                width: 30px;
                height: 40px;
            }
            .mod_list .filterlayer_price .filterlayer_price_choices {
                margin-top: 10px;
                display: flex;
            }
            .mod_list .filterlayer_price .filterlayer_price_choice:not(:last-child) {
                margin-right: 10px;
            }
            .mod_list .filterlayer_price .filterlayer_price_choice {
                -webkit-box-flex: 1;
                -webkit-flex: 1;
                flex: 1;
                box-sizing: border-box;
                text-align: center;
                line-height: 1.5;
                height: 40px;
                border-radius: 4px;
                background-color: #f7f7f7;
            }
            .mod_list .filterlayer_price .filterlayer_price_choice_text {
                font-size: 14px;
                color: #666;
            }
            .mod_list .filterlayer_price .filterlayer_price_choice_tips {
                margin-top: -1px;
                font-size: 12px;
                color: #999;
            }
            .mod_list .tags_selection {
                position: relative;
                margin: 0;
                padding: 10px 0 0 10px;
                display: flow-root;
            }
            .tags_selection {
                font-size: 14px;
                text-align: center;
                background-color: #fff;
            }
            .tags_selection .option {
                box-sizing: border-box;
                float: left;
                width: 33.33%;
                padding-right: 10px;
                height: 30px;
                line-height: 30px;
                margin-bottom: 10px;
                overflow: hidden;
            }
            .tags_selection .option a {
                position: relative;
                display: block;
                padding: 0 5px;
                color: #666;
                background-color: #f7f7f7;
                border-radius: 4px;
            }
            .mod_list .tags_selection a {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .filterlayer_bottom_buttons {
                display: flex;
                z-index: 10001;
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                box-shadow: 0 -1px 2px 0 rgba(0,0,0,.07);
            }
            .filterlayer_bottom_buttons .filterlayer_bottom_button.bg_1 {
                color: #333;
                background-color: #fff;
            }
            .filterlayer_bottom_buttons .filterlayer_bottom_button {
                -webkit-box-flex: 1;
                -webkit-flex: 1;
                flex: 1;
                font-size: 16px;
                height: 49px;
                line-height: 49px;
                text-align: center;
            }
            .filterlayer_bottom_buttons .filterlayer_bottom_button.bg_2 {
                color: #fff;
                background-color: #e93b3d;
            }
            .filterlayer_bottom_buttons .filterlayer_bottom_button {
                -webkit-box-flex: 1;
                -webkit-flex: 1;
                flex: 1;
                font-size: 16px;
                height: 49px;
                line-height: 49px;
                text-align: center;
            }
            .s_btn.disabled {
                background: #ccc;
                color: #999;
            }
            .s_btn {
                display: block;
                width: auto;
                height: 40px;
                line-height: 40px;
                text-align: center;
                border-radius: 2px;
                font-size: 16px;
                position: relative;
                margin: 15px 10px;
            }
        </style>
    <!--隐藏筛选弹出层s-->
        <div class="sf_layer_con show"  id="filterInner" style="display: none;" data-scroll="214">
            <ul class="mod_list">
                <li class="super_li no_arrow">
                    <div class="list_inner">
                        <div class="li_line">
                            <div class="big">价格</div>
                            <div class="right"></div>
                        </div>
                    </div>
                </li>
                <li class="filterlayer_price">
                    <div class="filterlayer_price_area"><input type="tel" class="filterlayer_price_area_input J_ping"
                                                               report-eventparam="" report-eventid="MFilter_StartPrice"
                                                               id="filterPriceMin" placeholder="最低价" data-val="">
                        <div class="filterlayer_price_area_hyphen"></div>
                        <input type="tel" class="filterlayer_price_area_input J_ping" report-eventparam=""
                               report-eventid="MFilter_EndPrice" id="filterPriceMax" placeholder="最高价" data-val="">
                    </div>
                    <div class="filterlayer_price_choices">
                        <div class="J_ping filterlayer_price_choice" data-filter="priceRange" start="486" end="1449"
                             text="¥486-¥1449" rd="0-9-57" ord="0-9-57" crd="0-9-58" report-eventparam="1"
                             report-eventid="MFilter_RecommendPrice">
                            <div class="filterlayer_price_choice_text">486-1449</div>
                            <div class="filterlayer_price_choice_tips">31%选择</div>
                        </div>
                        <div class="J_ping filterlayer_price_choice" data-filter="priceRange" start="1449" end="2699"
                             text="¥1449-¥2699" rd="0-9-59" ord="0-9-59" crd="0-9-60" report-eventparam="2"
                             report-eventid="MFilter_RecommendPrice">
                            <div class="filterlayer_price_choice_text">1449-2699</div>
                            <div class="filterlayer_price_choice_tips">27%选择</div>
                        </div>
                        <div class="J_ping filterlayer_price_choice" data-filter="priceRange" start="2699" end="10888"
                             text="¥2699-¥10888" rd="0-9-61" ord="0-9-61" crd="0-9-62" report-eventparam="3"
                             report-eventid="MFilter_RecommendPrice">
                            <div class="filterlayer_price_choice_text">2699-10888</div>
                            <div class="filterlayer_price_choice_tips">29%选择</div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">品牌</div>
                        <div class="right"><span class="words_10" r-mark="brand" slen="1"
                                                 style="max-width: 242px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option" ><a href="javascript:void 0;">华为（HUAWEI）</a></div>
                    <div class="J_ping option" ><a href="javascript:void 0;">华为（HUAWEI）</a></div>
                    <div class="J_ping option" ><a href="javascript:void 0;">华为（HUAWEI）</a></div>
                    <div class="J_ping option" ><a href="javascript:void 0;">华为（HUAWEI）</a></div>
                    <div class="J_ping option" ><a href="javascript:void 0;">华为（HUAWEI）</a></div>
                </div>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">操作系统</div>
                        <div class="right"><span class="words_10" r-mark="957" slen="1"
                                                 style="max-width: 210px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option " ><a href="javascript:void 0;">其它OS</a></div>
                </div>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">分辨率</div>
                        <div class="right"><span class="words_10" r-mark="3613" slen="1"
                                                 style="max-width: 226px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option " ><a href="javascript:void 0;">超高清屏（2K/3k/4K)</a></div>
                </div>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">存储卡</div>
                        <div class="right"><span class="words_10" r-mark="806" slen="1"
                                                 style="max-width: 226px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option " ><a href="javascript:void 0;">其它存储卡</a></div>

                </div>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">运行内存</div>
                        <div class="right"><span class="words_10" r-mark="3753" slen="1"
                                                 style="max-width: 210px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option" ><a href="javascript:void 0;">2GB</a></div>
                </div>
            </ul>
            <ul class="mod_list">
                <li>
                    <div class="list_inner li_line">
                        <div class="big">电池容量</div>
                        <div class="right"><span class="words_10" r-mark="3803" slen="1"
                                                 style="max-width: 210px;"></span></div>
                    </div>
                </li>
                <div class="tags_selection">
                    <div class="J_ping option " ><a href="javascript:void 0;">5000mAh以上</a></div>
                </div>
            </ul>
            <div id="filterClearBtn" class="J_ping s_btn disabled" disb="0" rd="0-9-4" report-eventparam=""
                 report-eventid="MFilter_Reset">清除选项
            </div>
        </div>
        <div class="filterlayer_bottom_buttons">
            {{--<span class="filterlayer_bottom_button bg_1" id="filterCBtn" rd="0-9-2">取消</span>--}}
            <span class="filterlayer_bottom_button bg_1 hide J_ping" id="filterBBtn" report-eventid="MFilter_Back">取消</span>
            {{--<span class="filterlayer_bottom_button bg_2 J_ping" id="filterFinishBtn" rd="0-9-1" report-eventparam="B" report-eventid="MFilter_Confirm">确认<span class="filterlayer_bottom_button_small_text"></span></span>--}}
            <span class="filterlayer_bottom_button bg_2 hide" id="filterSureBtn" rd="0-13-4">确认</span>
        </div>
    <!---->

@endsection
@section('script')
   <script>
       $('#filterBtn').click(function(){
           alert('1212');
       })
   </script>
@endsection