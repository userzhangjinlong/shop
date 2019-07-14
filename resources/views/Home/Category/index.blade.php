@extends('layouts.home-head')

@section('content')
    <style>
        .category-viewport{
            height: auto;
            min-height: 100%;
        }
        .category-categoryNewUi .jd-category-tab {
            width: 86px;
            background: #f8f8f8;
        }
        .jd-category-tab {
            float: left;
            min-width: 76px;
            width: 76px;
            height: auto;
            overflow-y: auto;
            min-height: 100%;
        }
        .category-categoryNewUi .jd-category-tab ul {
            width: 85px;
        }
        .category-categoryNewUi .jd-category-tab li.cur {
            background: #fff;
        }
        categoryNewUi .jd-category-tab li {
            background: #f8f8f8;
        }
        .jd-category-tab li.cur {
            background: #fff;
        }
        .jd-category-tab li {
            height: 46px;
            line-height: 46px;
            background: #fff;
            text-align: center;
            position: relative;
        }
        .category-viewport li, .category-viewport ul {
            display: block;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .category-categoryNewUi .jd-category-tab li.cur a {
            color: #e93b3d;
        }
        .jd-category-tab li.cur a {
            color: #f23030;
        }
        .category-categoryNewUi .jd-category-tab a {
            color: #333;
            font-size: 14px;
        }
        a:visited {
            text-decoration: none;
        }
        .jd-category-tab a {
            display: block;
            width: 100%;
            height: 46px;
            line-height: 46px;
            text-decoration: none;
            font-size: 13px;
            color: #080808;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        a {
            text-decoration: none;
            background: transparent;
            -webkit-tap-highlight-color: transparent;
        }
        .category-categoryNewUi .jd-category-content {
            background-color: #fff;
        }
        .jd-category-content {
            height: auto;
            min-height: 100%;
            width: 100%;
            font-size: 12px;
            color: #252525;
            background-color: #f3f5f7;
        }
        .category-categoryNewUi .jd-category-content .jd-category-content-wrapper {
            margin-left: 86px;
        }
        .jd-category-content {
            height: auto;
            min-height: 100%;
            width: 100%;
            font-size: 12px;
            color: #252525;
            background-color: #f3f5f7;
        }
        .jd-category-content #branchList {
            overflow: hidden;
            padding-bottom: 10px;
        }
        .jd-category-content .jd-category-div.cur {
            display: block;
        }
        .jd-category-content .jd-category-div {
            margin: 19px 7px 0;
        }
        .category-categoryNewUi .jd-category-content h4 {
            font-size: 14px;
            color: #333;
        }
        .jd-category-div:first-child h4 {
            display: inline-block;
        }
        .jd-category-content h4 {
            margin: 0;
            padding: 0;
            line-height: 1em;
            font-weight: 700;
        }
        .jd-category-content .jd-category-style-1 {
            border: 0;
            font-size: 0;
            padding: 7px 10px 0;
            overflow: hidden;
        }
        .jd-category-content ul {
            margin-top: 9px;
            background-color: #fff;
        }
        .jd-category-style-1 li {
            width: 32.8%;
            float: left;
            text-align: center;
        }
        .category-viewport li, .category-viewport ul {
            display: block;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .jd-category-style-1 a {
            text-decoration: none;
            color: #252525;
        }
        .category-categoryNewUi .jd-category-style-1 img {
            width: 70px;
            height: 70px;
        }
        .jd-category-style-1 img {
            border: 0;
        }
        .category-categoryNewUi .jd-category-style-1 span {
            color: #333;
            height: 35px;
            margin-top: 2px;
            -webkit-box-pack: start;
        }
        .jd-category-style-1 span {
            font-size: 12px;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-all;
            -webkit-box-align: center;

            z-index: 2;
            position: relative;
        }
    </style>
    <div id="categoryBody" class="category-viewport category-categoryNewUi">
        <div id="rootList" class="jd-category-tab">
            <div style="overflow: hidden; height: 643px;" >
                <ul style="transform: translateY(0px);" >
                    @foreach($cate_One as $v)
                    <li @if($id == $v->id) class="cur" @endif m_index="1" m_cid="WQR2006"  commonused="false"><a class="J_ping" href="{{ route('web.categorylist', [$v->id]) }}">{{ $v->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="jd-category-content">
            <div id="branchScroll" style="overflow: hidden; height: 643px; width: 328px;"
                 class="jd-category-content-wrapper">
                <div id="branchList" style="transform: translateY(0px);">
                    @foreach($list as $v)
                    <div class="jd-category-div cur">
                        <h4>{{ $v->name }}</h4>
                        <ul class="jd-category-style-1">
                            @if(!empty($v->children))
                                @foreach($v->children as $vv)
                                    <li><a class="J_ping"  href="{{ route('web.goodslist', [$vv->id]) }}"><img src="/{{ $vv->cateicon }}"><span>{{ $vv->name }}</span></a></li>
                                @endforeach
                            <div style="clear:both"></div>
                            @endif
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection