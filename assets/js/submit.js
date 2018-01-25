jQuery(function($) {
    $("#caag_form_init").submit();
    var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
    var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
    var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
    var safari_browser = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;
    /*Scrool on load - Prevent Display of iframe white spaces*/
    $('#caag-rental-iframe').load(function() {
        window.scroll(0,0);
    });
    
});
