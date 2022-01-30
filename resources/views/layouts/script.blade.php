<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('frontend/js/wow.js') }}"></script>

<!-- Main JS -->
<!-- <script src="js/app.min.js "></script> -->

<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        "use strict";
        $('#testimonials-list').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: false,
            nav: true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });
        $(".owl-prev").html('<i class="fa fa-angle-double-left"></i>');
        $(".owl-next").html('<i class="fa fa-angle-double-right"></i>');
    });
</script>
<!--<script type="text/javascript">
    $(document).ready(function() {
        var owl = $('.testi-boxes');
        owl.owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            nav: true,
            margin: 10,
            autoplay: 1000,
            autoPlaySpeed: 1000,
            autoplayTimeout: 1520,
            smartSpeed: 1500,
            animateIn: 'linear',
            animateOut: 'linear',
            autoplayHoverPause: true,
            responsive: {
                // breakpoint from 0 up
                1280: {
                    items: 1
                },
                0: {
                    items: 1
                },
                991: {
                    items: 1
                },
                480: {
                    items: 1
                },
                360: {
                    items: 1
                },
                320: {
                    items: 1
                }
            }

        });
        $(".owl-prev").html('<i class="fa fa-angle-double-left"></i>');
        $(".owl-next").html('<i class="fa fa-angle-double-right"></i>');

    });
</script>-->
<script type="text/javascript">
    $(document).ready(function() {
        var owl = $('.case-boxes');
        owl.owlCarousel({
            items: 3,
            stagePadding: 60,
            loop: true,
            dots: true,
            margin: 20,
            autoplay: false,
            slideTransition: 'linear',
            autoplayTimeout: 0,
            autoplaySpeed: 7000,
            autoplayHoverPause: true,
            responsive: {
                // breakpoint from 0 up
                1280: {
                    items: 3
                },
                0: {
                    items: 3
                },
                991: {
                    items: 3
                },
                480: {
                    items: 1
                },
                360: {
                    items: 1
                },
                320: {
                    items: 1
                }
            }

        });

    });
</script>

<script type="text/javascript">
        $('.testi-boxes').owlCarousel({
            loop: true,
            dots:false,
            nav:true,
            margin: 15,
            autoplay:true,
            autoplayTimeout: 5000,
            smartSpeed: 2500,
            autoplayHoverPause: true,
            responsive : {
                0:{
    				items:1,
    				nav:true
    			},
    			600:{
    				items:1,
    				nav:true
    			},
    			1000:{
    				items:1,
    				nav:true
    			}
            }
    
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var owl = $('.test-boxes');
        owl.owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            nav: true,
            margin: 10,
            autoplay: 1000,
            autoPlaySpeed: 1000,
            autoplayTimeout: 1520,
            smartSpeed: 1500,
            animateIn: 'linear',
            animateOut: 'linear',
            autoplayHoverPause: true,
            responsive: {
                // breakpoint from 0 up
                1280: {
                    items: 3
                },
                0: {
                    items: 4
                },
                991: {
                    items: 3
                },
                480: {
                    items: 1
                },
                360: {
                    items: 1
                },
                320: {
                    items: 1
                }
            }

        });
        $(".owl-prev").html('<i class="fa fa-angle-double-left"></i>');
        $(".owl-next").html('<i class="fa fa-angle-double-right"></i>');

    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var owl = $('.events-boxes');
        owl.owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            nav: true,
            margin: 10,
            autoplay: 1000,
            autoPlaySpeed: 1000,
            autoplayTimeout: 1520,
            smartSpeed: 1500,
            animateIn: 'linear',
            animateOut: 'linear',
            autoplayHoverPause: true,
            responsive: {
                // breakpoint from 0 up
                1280: {
                    items: 3
                },
                0: {
                    items: 4
                },
                991: {
                    items: 3
                },
                480: {
                    items: 1
                },
                360: {
                    items: 1
                },
                320: {
                    items: 1
                }
            }

        });
        $(".owl-prev").html('<i class="fa fa-angle-double-left"></i>');
        $(".owl-next").html('<i class="fa fa-angle-double-right"></i>');

    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        new WOW().init();
    });
</script>
<script type="text/javascript">
    var vsid = "kc22528471f10a6";
    (function() { 
    var vsjs = document.createElement('script'); vsjs.type = 'text/javascript'; vsjs.async = true; vsjs.setAttribute('defer', 'defer');
     vsjs.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.leadchatbot.com/vsa/chat.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(vsjs, s);
    })();
   </script>
   
   
</body>

</html>
