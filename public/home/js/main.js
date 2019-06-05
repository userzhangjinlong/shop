(function (a) {
    a("#my-menu").mmenu();
    a(".vm-menu").on("click", function () {
        a(".vm-dropdown").slideToggle()
    });
    a(".minicart-icon").on("click", function () {
        a(".cart-dropdown").slideToggle()
    });
    a(".vm-dropdown li").on("click", function () {
        a(this).children("ul.mega-menu").toggleClass("open")
    });
    var d = a(".sticker");
    var c = d.position();
    a(window).on("scroll", function () {
        var e = a(window).scrollTop();
        if (e > c.top) {
            d.addClass("stick")
        } else {
            d.removeClass("stick")
        }
    });
    a.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: "linear",
        scrollSpeed: 900,
        animation: "slide"
    });
    var b = a(".main-slider");
    b.slick({
        arrows: false,
        prevArrow: "<button type='button' class='slick-prev'><i class='fa fa-angle-left'></i></button>",
        nextArrow: "<button type='button' class='slick-next'><i class='fa fa-angle-right'></i></button>",
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        infinite: true,
        slidesToShow: 1,
        responsive: [{breakpoint: 767, settings: {arrows: false}}, {breakpoint: 479, settings: {arrows: false}}]
    });
    b.on("beforeChange", function (g, i, e, h) {
        var j = a(".main-slider h2");
        var f = a(".slick-current h2");
        j.removeClass("cssanimation leDoorCloseLeft sequence");
        f.addClass("cssanimation leDoorCloseLeft sequence")
    });
    b.on("afterChange", function (g, i, e, h) {
        var j = a(".main-slider h2");
        var f = a(".slick-current h2");
        j.removeClass("cssanimation leDoorCloseLeft sequence");
        f.addClass("cssanimation leDoorCloseLeft sequence")
    });
    a(".product-categories-carousel").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        adaptiveHeight: true,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 361, settings: {slidesToShow: 1, slidesToScroll: 1,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 992, settings: {slidesToShow: 3, slidesToScroll: 3}}, {
            breakpoint: 1200,
            settings: {slidesToShow: 3, slidesToScroll: 3}
        }, {breakpoint: 1400, settings: {slidesToShow: 4, slidesToScroll: 4}},]
    });
    a(".five-catItems").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        adaptiveHeight: true,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 1400, settings: {slidesToShow: 4,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2,}
        }, {breakpoint: 361, settings: {slidesToShow: 1,}}]
    });
    a(".one-carousel").slick({
        dots: true,
        list: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
    });
    a(".product-deals").slick({
        dots: false,
        list: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        arrows: false,
        responsive: [{breakpoint: 992, settings: {slidesToShow: 2, slidesToScroll: 2,}}, {
            breakpoint: 481,
            settings: {slidesToShow: 1, slidesToScroll: 1,}
        }]
    });
    a(".product-carousel").slick({
        dots: true,
        list: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 5,
        slidesToScroll: 5,
        adaptiveHeight: true,
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 361, settings: {slidesToShow: 1, slidesToScroll: 1,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 992, settings: {slidesToShow: 3, slidesToScroll: 3}}, {
            breakpoint: 1200,
            settings: {slidesToShow: 3, slidesToScroll: 3}
        }, {breakpoint: 1400, settings: {slidesToShow: 4, slidesToScroll: 4}},]
    });
    a(".products-three").slick({
        dots: true,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 4,
        slidesToScroll: 4,
        adaptiveHeight: true,
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 1400, settings: {slidesToShow: 3, slidesToScroll: 3}}, {
            breakpoint: 993,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 769, settings: {slidesToShow: 2, slidesToScroll: 2,}}, {
            breakpoint: 361,
            settings: {slidesToShow: 1, slidesToScroll: 1,}
        }]
    });
    a(".four-items").slick({
        dots: true,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 4,
        slidesToScroll: 4,
        adaptiveHeight: true,
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 993, settings: {slidesToShow: 3, slidesToScroll: 3,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 361, settings: {slidesToShow: 1, slidesToScroll: 1,}}]
    });
    a(".best-seller").slick({
        dots: true,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 5,
        slidesToScroll: 5,
        adaptiveHeight: true,
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 361, settings: {slidesToShow: 1, slidesToScroll: 1,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 992, settings: {slidesToShow: 3, slidesToScroll: 3}}, {
            breakpoint: 1200,
            settings: {slidesToShow: 3, slidesToScroll: 3}
        }, {breakpoint: 1400, settings: {slidesToShow: 4, slidesToScroll: 4}},]
    });
    a(".product-carousel-fullwidth").slick({
        dots: true,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 6,
        slidesToScroll: 6,
        adaptiveHeight: true,
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 1400, settings: {slidesToShow: 4, slidesToScroll: 4,}}, {
            breakpoint: 993,
            settings: {slidesToShow: 3, slidesToScroll: 3,}
        }, {breakpoint: 769, settings: {slidesToShow: 2, slidesToScroll: 2,}}, {
            breakpoint: 361,
            settings: {slidesToShow: 1, slidesToScroll: 1,}
        }]
    });
    a(".blog-carousels").slick({
        dots: false,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 993, settings: {slidesToShow: 3, slidesToScroll: 3,}}, {
            breakpoint: 769,
            settings: {slidesToShow: 2, slidesToScroll: 2,}
        }, {breakpoint: 481, settings: {slidesToShow: 1, slidesToScroll: 1,}}]
    });
    a(".recent-products").slick({
        dots: false,
        list: false,
        autoplay: false,
        autoplaySpeed: 5000,
        infinite: true,
        speed: 700,
        slidesToShow: 3,
        slidesToScroll: 3,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
        responsive: [{breakpoint: 769, settings: {slidesToShow: 2, slidesToScroll: 2,}}, {
            breakpoint: 361,
            settings: {slidesToShow: 1, slidesToScroll: 1,}
        }]
    });
    a(".brand-items").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 8,
        slidesToScroll: 1,
        adaptiveHeight: true,
        autoplay: true,
        responsive: [{breakpoint: 1400, settings: {slidesToShow: 5,}}, {
            breakpoint: 992,
            settings: {slidesToShow: 4,}
        }, {breakpoint: 481, settings: {slidesToShow: 2,}}],
        arrows: false,
        prevArrow: '<i class="fa fa-angle-left"></i>',
        nextArrow: '<i class="fa fa-angle-right"></i>',
    });
    a("[data-countdown]").each(function () {
        var e = a(this), f = a(this).data("countdown");
        e.countdown(f, function (g) {
            e.html(g.strftime('<span class="cdown days"><span class="time-count">%-D</span><p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'))
        })
    });
    a("#slider-range").slider({
        range: true, min: 40, max: 600, values: [60, 570], slide: function (e, f) {
            a("#amount").val("$" + f.values[0] + " - $" + f.values[1])
        }
    });
    a("#amount").val("$" + a("#slider-range").slider("values", 0) + " - $" + a("#slider-range").slider("values", 1));
    a(".qtybutton").on("click", function () {
        var e = a(this);
        var g = e.parent().find("input").val();
        if (e.text() == "+") {
            var f = parseFloat(g) + 1
        } else {
            if (g > 0) {
                var f = parseFloat(g) - 1
            } else {
                f = 0
            }
        }
        e.parent().find("input").val(f)
    });
    a(document).ready(function () {
        a(".venobox").venobox()
    })
})(jQuery);