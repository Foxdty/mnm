<!-- Js Plugins -->
<script src="js/user/jquery-3.3.1.min.js"></script>
<script src="js/user/bootstrap.min.js"></script>
<script src="js/user/jquery-ui.min.js"></script>
<script src="js/user/jquery.countdown.min.js"></script>
<script src="js/user/jquery.nice-select.min.js"></script>
<script src="js/user/jquery.zoom.min.js"></script>
<script src="js/user/jquery.dd.min.js"></script>
<script src="js/user/jquery.slicknav.js"></script>
<script src="js/user/owl.carousel.min.js"></script>
<script src="js/user/main.js"></script>
<script>
    // $(document).ready(function(){
    //     $('ul#user-menu li:first-child').addClass('active');
    //     $('ul#user-menu li').each(function(){
    //         $(this).click(function(){
    //             $('ul#user-menu li').removeClass('active');
    //             $(this).addClass('active');
    //         });
    //     });
    // });

    $(document).ready(function() {
        var path = this.location.href.toLowerCase();
        $("ul#user-menu li:first-child").addClass("active");
        $("ul#user-menu li a").each(function() {
            if (path.indexOf((this).href.toLowerCase()) >= 0) {
                $("ul#user-menu li").removeClass("active")
                $(this).parent().addClass("active");
            }
        })
    });
</script>
