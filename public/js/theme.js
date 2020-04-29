;(function ($) {
    "use strict"


//	var nav_offset_top = $('header').height();
//    /*-------------------------------------------------------------------------------
//	  Navbar
//	-------------------------------------------------------------------------------*/
//
//	//* Navbar Fixed
//    function navbarFixed(){
//        if ( $('.header_area').length ){
//            $(window).scroll(function() {
//                var scroll = $(window).scrollTop();
//                if (scroll >= nav_offset_top ) {
//                    $(".header_area").addClass("navbar_fixed");
//                } else {
//                    $(".header_area").removeClass("navbar_fixed");
//                }
//            });
//        };
//    };
//    navbarFixed();


    /*----------------------------------------------------*/

    /*  Parallax Effect js
    /*----------------------------------------------------*/
    function parallaxEffect() {
        $('.bg-parallax').parallax();
    }

    parallaxEffect();


    /*----------------------------------------------------*/
    /*  Causes Slider
    /*----------------------------------------------------*/
//    function causes_slider(){
//        if ( $('.causes_slider').length ){
//            $('.causes_slider').owlCarousel({
//                loop:true,
//                margin: 30,
//                items: 3,
//                nav: false,
//                autoplay: false,
//                smartSpeed: 1500,
//                dots:true,
//                responsiveClass: true,
//                responsive: {
//                    0: {
//                        items: 1,
//                    },
//                    768: {
//                        items: 2,
//                    },
//                    992: {
//                        items: 3,
//                    }
//                }
//            })
//        }
//    }
//    causes_slider();
//
//	/*----------------------------------------------------*/
//    /*  Event Slider
//    /*----------------------------------------------------*/
//    function event_slider(){
//        if ( $('.event_slider').length ){
//            $('.event_slider').owlCarousel({
//                loop:true,
//                margin: 45,
//                items: 2,
//                nav: false,
//                autoplay: false,
//                smartSpeed: 1500,
//                dots:true,
//                responsiveClass: true,
//                responsive: {
//                    0: {
//                        items: 1,
//						margin: 20,
//                    },
//                    992: {
//                        margin: 20,
//						items: 2,
//                    },
//                    1199: {
//                        margin: 45,
//						items: 2,
//                    }
//                }
//            })
//        }
//    }
//    event_slider();
//
//	/*----------------------------------------------------*/
//    /*  Testimonials Slider
//    /*----------------------------------------------------*/
//    function testi_slider(){
//        if ( $('.testi_slider').length ){
//            $('.testi_slider').owlCarousel({
//                loop:true,
//                margin: 30,
//                items: 2,
//                nav: false,
//                autoplay: false,
//                smartSpeed: 1500,
//                dots:true,
//                responsiveClass: true,
//                responsive: {
//                    0: {
//                        items: 1,
//                    },
//                    576: {
//                        items: 2,
//                    }
//                }
//            })
//        }
//    }
//    testi_slider();
//
    /*----------------------------------------------------*/

    /*  Clients Slider
    /*----------------------------------------------------*/
    function clients_slider() {
        if ($('.clients_slider').length) {
            $('.clients_slider').owlCarousel({
                loop: true,
                margin: 30,
                items: 5,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    400: {
                        items: 2,
                    },
                    575: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                    992: {
                        items: 5,
                    }
                }
            })
        }
    }

    clients_slider();

    /*----------------------------------------------------*/

    /*  Testimonials Slider
    /*----------------------------------------------------*/
    function testi_slider() {
        if ($('.testi_slider').length) {
            $('.testi_slider').owlCarousel({
                loop: true,
                margin: 30,
                items: 2,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    576: {
                        items: 2,
                    }
                }
            })
        }
    }

    testi_slider();

    /*----------------------------------------------------*/

    /*  MailChimp Slider
    /*----------------------------------------------------*/
    function mailChimp() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }

    mailChimp();

    $('select').niceSelect();

    /*----------------------------------------------------*/
    /*  Simple LightBox js
    /*----------------------------------------------------*/
    if ($('.imageGallery1 .light').length) $('.imageGallery1 .light').simpleLightbox();

    /*----------------------------------------------------*/
    /*  Jquery Ui slider js
    /*----------------------------------------------------*/
    $("#slider-range, #slider-range2").slider({
        range: true,
        min: 0,
        max: 500,
        values: [80, 500],
        slide: function (event, ui) {
            $("#amount, #amount2").val("$" + ui.values[0] + " $" + ui.values[1]);
        }
    });
    $("#amount, #amount2").val("$" + $("#slider-range, #slider-range2").slider("values", 0) +
        "   $" + $("#slider-range, #slider-range2").slider("values", 1));


    $("#slider-range2").slider({
        range: true,
        min: 0,
        max: 500,
        values: [80, 500],
        slide: function (event, ui) {
            $("#amount2").val("$" + ui.values[0] + " $" + ui.values[1]);
        }
    });
    $("#amount2").val("$" + $("#slider-range2").slider("values", 0) +
        "   $" + $("#slider-range2").slider("values", 1));

//	/*----------------------------------------------------*/
//    /*  Image Gallery js
//    /*----------------------------------------------------*/
//    function galleryMasonry(){
//        if ( $('.gallery_inner').length ){
//            $('.gallery_inner').imagesLoaded( function() {
//              // images have loaded
//                // Activate isotope in container
//                $(".gallery_inner").isotope({
//                    itemSelector: ".gallery_item",
//                    layoutMode: 'masonry',
//                    animationOptions: {
//                        duration: 750,
//                        easing: 'linear'
//                    }
//                });
//            })
//        }
//    }
//    galleryMasonry();


    if ($("input[type='tel']").length) {
        $("input[type='tel']").on("input", function(event) {
            const thisInput = $(event.target);
            thisInput.val(destroyMask(this.value));
            this.value = createMask(thisInput.val());

        });


        function destroyMask(str) {
            return str.replace(/\D/g, '').substring(0, 10);
        }

        function createMask(str) {
            console.log(str);
            return str.replace(/(\d{3})(\d{3})(\d{2})(\d{2})/, "($1)-$2-$3-$4");
        }
    }

})(jQuery)
