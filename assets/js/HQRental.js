jQuery(function($) {
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    if(is_safari)
    $("#caag-rental-iframe").load(function(){
        $("#caag-load-img").hide();
        var doc = this.contentDocument || this.contentWindow.document;
        var target = doc.getElementById("save-reservation-form");
          
        target.innerHTML = "Found It!";
    });


});