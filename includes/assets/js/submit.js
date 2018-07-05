jQuery(function($) {
    $("#caag_form_init").submit();
    var safari_browser = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;
    /*Scrool on load - Prevent Display of iframe white spaces*/
    $('#caag-rental-iframe').load(function() {
        window.scroll(0,0);
    });
    
});
