<!-- Js Plugins -->
<script src="user/js/jquery-3.3.1.min.js"></script>
<script src="user/js/bootstrap.min.js"></script>
<script src="user/js/jquery-ui.min.js"></script>
<script src="user/js/jquery.countdown.min.js"></script>
<script src="user/js/jquery.nice-select.min.js"></script>
<script src="user/js/jquery.zoom.min.js"></script>
<script src="user/js/jquery.dd.min.js"></script>
<script src="user/js/jquery.slicknav.js"></script>
<script src="user/js/owl.carousel.min.js"></script>
<script src="user/js/main.js"></script>
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
