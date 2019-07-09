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
    </style>
    <div class="sticker mobile-header">
        <a href="javascript:" class="item has J_ping" dtype="sort" rd="0-24-3" ord="0-24-3" crd="0-24-4" id="sortTab" report-eventid="MList_Comprehensive"><span rd="0-24-3">默认<i class="icon_tri" rd="0-24-3"></i></span></a>
        <a href="javascript:" class="item J_ping" dtype="sale" rd="0-24-9" id="saleTab" report-eventid="MList_SalesVolume">销量</a>
        <a href="javascript:" class="item hide" dtype="article" rd="0-24-25" id="articleTab">价格</a>
        <a href="javascript:" class="item btn_sf J_ping" id="filterBtn" rd="0-24-52" report-eventid="MList_Filter">筛选</a>
    </div>
    <div class="shop-area" style="padding-top: 0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
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
                </div>
                <div class="col-xl-10 col-lg-9">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-6">
                            <div class="products-sort">
                                <form><select name="sort">
                                        <option value="0">默认</option>
                                        <option value="1">销量低-高</option>
                                        <option value="4">销量高-低</option>
                                        <option value="2">价格低-高</option>
                                        <option value="3">价格高-低</option>
                                    </select></form>
                            </div>
                            {{--<div class="products-sort">--}}
                                {{--<form><label>Show :</label><select>--}}
                                        {{--<option>12</option>--}}
                                        {{--<option>8</option>--}}
                                        {{--<option>4</option>--}}
                                    {{--</select></form>--}}
                            {{--</div>--}}
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="site-pagination pull-right">
                                <ul>
                                    <li><a href="#" class="active">1</a></li>
                                    <li>of</li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                </ul>
                            </div>
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
                                <ul>
                                    <li><a href="#" class="active">1</a></li>
                                    <li>of</li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-results pull-right"><span>Showing 1–3 of 60 results</span>
                                {{--<div class="products-sort ml-35 mr-0">
                                    <form><label>Show :</label><select>
                                            <option>12</option>
                                            <option>8</option>
                                            <option>4</option>
                                        </select></form>
                                </div>--}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div><!--products-area end-->

@endsection