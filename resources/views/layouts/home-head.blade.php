<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'LAN商城') }}</title>
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="{{ asset('home/images/logo.png') }}}"><!-- Place favicon.ico in the root directory -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- bootstrap v4.0.0 -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}"><!-- fontawesome-icons css -->
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}"><!-- themify-icons css -->
    <link rel="stylesheet" href="{{ asset('home/css/themify-icons.css') }}"><!-- elegant css -->
    <link rel="stylesheet" href="{{ asset('home/css/elegant.css') }}"><!-- elegant css -->
    <link rel="stylesheet" href="{{ asset('home/css/jquery.mmenu.css') }}"><!-- jquery-ui.min css -->
    <link rel="stylesheet" href="{{ asset('home/css/jquery-ui.min.css') }}"><!-- venobox css -->
    <link rel="stylesheet" href="{{ asset('home/css/venobox.css') }}"><!-- slick css -->
    <link rel="stylesheet" href="{{ asset('home/css/slick.css') }}"><!-- slick-theme css -->
    <link rel="stylesheet" href="{{ asset('home/css/slick-theme.css') }}"><!-- cssanimation css -->
    <link rel="stylesheet" href="{{ asset('home/css/cssanimation.min.css') }}"/><!-- animate css -->
    <link rel="stylesheet" href="{{ asset('home/css/animate.css') }}"/><!-- helper css -->
    <link rel="stylesheet" href="{{ asset('home/css/helper.css') }}"><!-- style css -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}"><!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong>browser. Please
<a href="https://browsehappy.com/">upgrade your browser</a>to improve your experience and security.</p>
<![endif]-->
<!--header-area start-->
<header class="header-area">
    <div class="desktop-header"><!--header-top-->
        <div class="header-top">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="topbar-left">
                            <ul class="list-none">
                                <li>联系我们: <span>13888888888</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--header-bottom-->
        <div class="sticker header-bottom">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo"><a href="/"><img src="{{ asset('home/images/logo.png') }}" alt="logo"/></a></div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mainmenu">
                            <nav>
                                <ul>
                                    <li><a href="/">首页</a>
                                    </li>
                                    <li><a href="#"><span class="text-label label-featured">Featured</span> Shop <b
                                                    class="caret"></b></a>
                                        <ul class="mega-menu">
                                            <li class="megamenu-single"><span class="mega-menu-title">Shop Page</span>
                                                <ul>
                                                    <li><a href="shop.html">Shop Grid</a></li>
                                                    <li><a href="shop-list.html">Shop List</a></li>
                                                    <li><a href="shop-list-col-3.html">Shop Column 3</a></li>
                                                    <li><a href="product-details.html">Product Details</a></li>
                                                    <li><a href="poduct-details-sidebar.html">Product Details
                                                            Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li class="megamenu-single"><span class="mega-menu-title">Featured</span>
                                                <ul>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                                    <li><a href="shop-compare.html">Shop Compare</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                </ul>
                                            </li>
                                            <li class="megamenu-single"><span class="mega-menu-title">Pages</span>
                                                <ul>
                                                    <li><a href="about.html">About </a></li>
                                                    <li><a href="faq.html">FAQ</a></li>
                                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                                    <li><a href="404.html">404 Error</a></li>
                                                </ul>
                                            </li>
                                            <li class="megamenu-single"><span class="mega-menu-title">Blog</span>
                                                <ul>
                                                    <li><a href="blog.html">Blog List</a></li>
                                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                                    <li><a href="blog-fullwidth.html">Blog Fullwidth</a></li>
                                                    <li><a href="blog-details.html">Blog Details</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><span class="text-label label-hot">Hot</span> Pages <b
                                                    class="caret"></b></a>
                                        <ul class="submenu">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li><a href="404.html">404 Eror</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Blog <b class="caret"></b></a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-grid.html">Blog Grid</a></li>
                                            <li><a href="blog-fullwidth.html">Blog Full Width</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="#">Purchase Theme</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="register-login pull-right"><a href="{{ route('web.reg') }}">注册</a><span>/</span><a href="{{ route('web.login') }}">登录</a></div>
                    </div>
                </div>
            </div>
        </div><!--products-search-->
        <div class="products-search">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-xl-2 col-lg-3">
                        <div class="collapse-menu mt-0">
                            <ul>
                                <li><a href="javascript:void(0);" class="vm-menu"><i class="fa fa-navicon"></i><span>所有分类</span></a>
                                    <ul class="vm-dropdown">
                                        @foreach($cate_list as $v)
                                        <li><a href="{{ $v->id }}"><i class="fa fa-laptop"></i>{{ $v->name }} @if(!empty($v->children))<b class="caret"></b>@endif</a>
                                            <ul class="mega-menu">
                                                @if(!empty($v->children))
                                                    @foreach($v->children as $vv)
                                                    <li class="megamenu-single"><span
                                                                class="mega-menu-title">{{ $vv->name }}</span>
                                                        <ul>
                                                            @if(!empty($vv->children))
                                                                @foreach($vv->children as $vvv)
                                                                <li><a href="{{ $vvv->id }}">{{ $vvv->name }}</a></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="search-box"><select>
                                <option value="0">所有分类</option>
                                @foreach($cate_One as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                @endforeach
                            </select><input type="text" placeholder="What do you need?"/>
                            <button>搜索</button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3">
                        <div class="mini-cart pull-right">
                            <ul>
                                <li><a href="#" title="Track Your Order"><i class="ti-truck"></i></a></li>
                                <li><a href="#"><i class="icon_heart_alt"></i><span>1</span></a></li>
                                <li><a href="javascript:void(0);" class="minicart-icon"><i class="icon_bag_alt"></i>$180.00<span>2</span></a>
                                    <div class="cart-dropdown">
                                        <ul>
                                            <li>
                                                <div class="mini-cart-thumb"><a href="#"><img
                                                                src="{{ asset('home/images/products/cart/thumb-1.jpg') }}" alt=""/></a></div>
                                                <div class="mini-cart-heading"><span>$460.00 x 1</span><h5><a href="#">Kabino
                                                            Bedside Table</a></h5></div>
                                                <div class="mini-cart-remove">
                                                    <button><i class="ti-close"></i></button>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="mini-cart-thumb"><a href="#"><img
                                                                src="{{ asset('home/images/products/cart/thumb-2.jpg') }}" alt=""/></a></div>
                                                <div class="mini-cart-heading"><span>$460.00 x 1</span><h5><a href="#">Kabino
                                                            Bedside Table</a></h5></div>
                                                <div class="mini-cart-remove">
                                                    <button><i class="ti-close"></i></button>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="minicart-total fix"><span class="pull-left">total:</span><span
                                                    class="pull-right">$460.00</span></div>
                                        <div class="mini-cart-checkout"><a href="shopping-cart.html"
                                                                           class="btn-common view-cart">VIEW CARD</a><a
                                                    href="checkout.html" class="btn-common checkout mt-10">CHECK OUT</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--mobile-header-->
    <div class="sticker mobile-header">
        <div class="container-fluid"><!--logo and cart-->
            <div class="row align-items-center">
                <div class="col-sm-4 col-6">
                    <div class="logo"><a href="/"><img src="{{ asset('home/images/logo.png') }}" alt="logo"/></a></div>
                </div>
                <div class="col-sm-8 col-6">
                    <div class="mini-cart text-right">
                        <ul>
                            <li><a href="#"><i class="icon_heart_alt"></i><span>1</span></a></li>
                            <li class="minicart-icon"><a href="#"><i class="icon_bag_alt"></i><span>2</span></a>
                                <div class="cart-dropdown">
                                    <ul>
                                        <li>
                                            <div class="mini-cart-thumb"><a href="#"><img
                                                            src="{{ asset('home/images/products/cart/thumb-1.jpg') }}" alt=""/></a></div>
                                            <div class="mini-cart-heading"><span>$460.00 x 1</span><h5><a href="#">Kabino
                                                        Bedside Table</a></h5></div>
                                            <div class="mini-cart-remove">
                                                <button><i class="ti-close"></i></button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mini-cart-thumb"><a href="#"><img
                                                            src="{{ asset('home/images/products/cart/thumb-2.jpg') }}" alt=""/></a></div>
                                            <div class="mini-cart-heading"><span>$460.00 x 1</span><h5><a href="#">Kabino
                                                        Bedside Table</a></h5></div>
                                            <div class="mini-cart-remove">
                                                <button><i class="ti-close"></i></button>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="minicart-total fix"><span class="pull-left">total:</span><span
                                                class="pull-right">$460.00</span></div>
                                    <div class="mini-cart-checkout"><a href="shopping-cart.html"
                                                                       class="btn-common view-cart">VIEW CARD</a><a
                                                href="checkout.html" class="btn-common checkout mt-10">CHECK OUT</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--search-box-->
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="search-box mt-sm-15"><select>
                            <option value="0">所有分类</option>
                            @foreach($cate_One as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select><input type="text" placeholder="What do you need?"/>
                        <button>搜索</button>
                    </div>
                </div>
            </div><!--site-menu-->
            <div class="row mt-sm-10">
                <div class="col-lg-12"><a href="/" class="mmenu-icon pull-left"><i class="fa fa-bars"></i></a>
                    <div class="mainmenu">
                        <nav id="my-menu">
                            <ul>
                                <li><a href="/">Home</a>
                                </li>
                                <li><a href="#"><span class="text-label label-featured">Featured</span> Shop <b
                                                class="caret"></b></a>
                                    <ul>
                                        <li><span class="mega-menu-title">Shop Page</span>
                                            <ul>
                                                <li><a href="shop.html">Shop Grid</a></li>
                                                <li><a href="shop-list.html">Shop List</a></li>
                                                <li><a href="shop-list-col-3.html">Shop Column 3</a></li>
                                                <li><a href="product-details.html">Product Details</a></li>
                                                <li><a href="poduct-details-sidebar.html">Product Details Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><span class="mega-menu-title">Features</span>
                                            <ul>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                                <li><a href="shop-compare.html">Shop Compare</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                            </ul>
                                        </li>
                                        <li><span class="mega-menu-title">Pages</span>
                                            <ul>
                                                <li><a href="about.html">About </a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                                <li><a href="404.html">404 Error</a></li>
                                            </ul>
                                        </li>
                                        <li><span class="mega-menu-title">Blog</span>
                                            <ul>
                                                <li><a href="blog.html">Blog List</a></li>
                                                <li><a href="blog-grid.html">Blog Grid</a></li>
                                                <li><a href="blog-fullwidth.html">Blog Fullwidth</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="text-label label-hot">Hot</span> Pages <b
                                                class="caret"></b></a>
                                    <ul class="submenu">
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                        <li><a href="404.html">404 Eror</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Blog <b class="caret"></b></a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-fullwidth.html">Blog Full Width</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="#">Purchase Theme</a></li>
                            </ul>
                        </nav>
                    </div><!--category-->
                    <div class="collapse-menu mt-0 pull-right">
                        <ul>
                            <li><a href="javascript:void(0);" class="vm-menu"><i class="fa fa-navicon"></i><span>所有分类</span></a>
                                <ul class="vm-dropdown">
                                    @foreach($cate_list as $v)
                                    <li><a href="{{ $v->id }}"><i class="fa fa-laptop"></i>{{ $v->name }} @if(!empty($v->children))<b class="caret"></b>@endif</a>
                                        <ul class="mega-menu">
                                            @if(!empty($v->children))
                                                @foreach($v->children as $vv)
                                                    <li class="megamenu-single"><span class="mega-menu-title">{{ $vv->name }}</span>
                                                        <ul>
                                                            @if(!empty($vv->children))
                                                                @foreach($vv->children as $vvv)
                                                                    <li><a href="{{ $vvv->id }}">{{ $vvv->name }}</a></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!--header-area end-->
@yield('content')
<!--footer-area start-->
<footer class="footer-area mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="company-info"><img src="{{ asset('home/images/logo.png') }}" alt="logo"/>
                    <p>101 E 129th St, East Chicago, <br/>IN 46312, US</p>
                    <p>Phone: 001-1234-88888</p>
                    <p>Email: info.deercreative@gmail.com</p></div>
                <div class="copyright"><p>Copyright 2019 &copy; <a href="http://www.bootstrapmb.com/">HakDuck</a>. All
                        rights reserved.</p></div>
                <div class="payment-gateways"><img src="{{ asset('home/images/footer/p1.png') }}" alt=""/><img
                            src="{{ asset('home/images/footer/p2.png') }}" alt=""/><img src="{{ asset('home/images/footer/p3.png') }}" alt=""/><img
                            src="{{ asset('home/images/footer/p4.png') }}" alt=""/><img src="{{ asset('home/images/footer/p5.png') }}" alt=""/><img
                            src="{{ asset('home/images/footer/p6.png') }}" alt=""/></div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="fooer-widget"><h4>Find It Fast</h4>
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Laptop & Computers</a></li>
                            <li><a href="#">Smart Phone & Tablets</a></li>
                            <li><a href="#">TV & Audio</a></li>
                            <li><a href="#">Cameras & Photography</a></li>
                            <li><a href="#">Gadgets</a></li>
                            <li><a href="#">Car Electronic & GP5</a></li>
                            <li><a href="#">Accesories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3 mt-sm-45">
                <div class="fooer-widget"><h4>Information</h4>
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Find a Store</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Delivery information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Gift Cards</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3 mt-sm-45">
                <div class="fooer-widget"><h4>Customer Care</h4>
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Returns / Exchange</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Product Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mt-sm-45">
                <div class="footer-widget">
                    <div class="subscribe-form"><h3>Sign Up to <strong>Newsletter</strong></h3>
                        <p>Subscribe our newsletter gor get notification about information discount.</p><input
                                type="text" placeholder="Your email address"/>
                        <button>Subscribe</button>
                    </div>
                    <div class="social-icons style-2"><strong>GET IN TOUCH !</strong><a href="#"><i
                                    class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i
                                    class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-youtube"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</footer><!--footer-area end--><!-- modernizr js -->
<script src="{{ asset('home/js/vendor/modernizr-3.6.0.min.js') }}"></script><!-- jquery-3.3.1 version -->
<script src="{{ asset('home/js/vendor/jquery-3.2.1.min.js') }}"></script><!-- bootstra.min js -->
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script><!-- mmenu js -->
<script src="{{ asset('home/js/jquery.mmenu.js') }}"></script><!-- easing js -->
<script src="{{ asset('home/js/jquery.easing.min.js') }}"></script><!---slick-js-->
<script src="{{ asset('home/js/slick.min.js') }}"></script><!---letteranimation-js-->
<script src="{{ asset('home/js/letteranimation.min.js') }}"></script><!-- jquery-ui js -->
<script src="{{ asset('home/js/jquery-ui.min.js') }}"></script><!-- jquery.countdown js -->
<script src="{{ asset('home/js/jquery.countdown.min.js') }}"></script><!-- venobox js -->
<script src="{{ asset('home/js/venobox.min.js') }}"></script><!-- plugins js -->
<script src="{{ asset('home/js/plugins.js') }}"></script><!-- main js -->
<script src="{{ asset('home/js/main.js') }}"></script><!-- Modal -->
@yield('script')
<div class="modal fade" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="tab-content">
                            <div id="product-1" class="tab-pane fade in show active">
                                <div class="product-details-thumb"><img
                                            src="{{ asset('home/images/products/product-details/1.jpg') }}" alt=""/></div>
                            </div>
                            <div id="product-2" class="tab-pane fade">
                                <div class="product-details-thumb"><img
                                            src="{{ asset('home/images/products/product-details/2.jpg') }}" alt=""/></div>
                            </div>
                            <div id="product-3" class="tab-pane fade">
                                <div class="product-details-thumb"><img
                                            src="{{ asset('home/images/products/product-details/3.jpg') }}" alt=""/></div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs products-nav-tabs horizontal quick-view mt-10">
                            <li><a class="active" data-toggle="tab" href="#product-1"><img
                                            src="{{ asset('home/images/products/product-details/thumb-1.jpg') }}" alt=""/></a></li>
                            <li><a data-toggle="tab" href="#product-2"><img
                                            src="{{ asset('home/images/products/product-details/thumb-2.jpg') }}" alt=""/></a></li>
                            <li><a data-toggle="tab" href="#product-3"><img
                                            src="{{ asset('home/images/products/product-details/thumb-3.jpg') }}" alt=""/></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="product-details-desc"><h2>Apple The New MacBook Retina 2016 MLHA2 12
                                        inches</h2>
                                    <ul>
                                        <li>1.6 GHz dual-core Intel Core i5 (Turbo Boost up to 2.7 GHz) with 3 MB shared
                                            L3 cache 8 GB of 1600 MHz LPDDR3 RAM; 128 GB PCIe-based flash storage
                                        </li>
                                        <li>13.3-Inch (diagonal) LED-backlit Glossy Widescreen Display, 1440 x 900
                                            resolution Intel HD Graphics 6000
                                        </li>
                                        <li>OS X El Capitan, Up to 12 Hours of Battery Life Macbook Air does not have a
                                            Retina display on any model.
                                        </li>
                                    </ul>
                                    <div class="product-meta">
                                        <ul class="list-none">
                                            <li>SKU: 00012 <span>|</span></li>
                                            <li>Categories: <a href="#">Tech</a><a href="#">Macbook</a><a href="#">Laptop</a><span>|</span>
                                            </li>
                                            <li>Tags: <a href="#">Tech,</a><a href="#">Apple</a></li>
                                        </ul>
                                    </div>
                                    <div class="social-icons style-5"><span>Share Link:</span><a href="#"><i
                                                    class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a
                                                href="#"><i class="fa fa-google-plus"></i></a><a href="#"><i
                                                    class="fa fa-rss"></i></a></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product-action stuck text-left">
                                    <div class="free-delivery"><a href="#"><i class="ti-truck"></i>Free Delivery</a>
                                    </div>
                                    <div class="product-price-rating">
                                        <div>
                                            <del>629.99</del>
                                        </div>
                                        <span>$495.00</span>
                                        <div class="pull-right"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star-o"></i></div>
                                    </div>
                                    <div class="product-colors mt-20"><label>Select Color:</label>
                                        <ul class="list-none">
                                            <li>Red</li>
                                            <li>Black</li>
                                            <li>Blue</li>
                                        </ul>
                                    </div>
                                    <div class="product-quantity mt-15"><label>Quatity:</label><input type="number"
                                                                                                      value="1"/></div>
                                    <div class="add-to-get mt-50"><a href="#" class="add-to-cart">Add to Cart</a><a
                                                href="#" class="add-to-cart compare">+ ADD to Compare</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
