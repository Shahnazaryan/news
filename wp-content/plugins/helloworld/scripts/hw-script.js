jQuery(document).ready(function( $ ){
    var thehours = new Date().getHours();
    if (thehours >= 0 && thehours < 12) {
        $(".test-shortcode").addClass("morning");
    } else if (thehours >= 12 && thehours < 17) {
        $(".test-shortcode").addClass("afternoon");
    } else if (thehours >= 17 && thehours < 24) {
        $(".test-shortcode").addClass("evening");
    }
});