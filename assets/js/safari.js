jQuery(function($) {
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    if(is_safari){
        var url = document.getElementById('caag-rental-iframe').src;
        var tabOrWindow = window.open(url, '_blank');
        tabOrWindow.focus();
    }
    $("#caag-rental-iframe").hide();
});