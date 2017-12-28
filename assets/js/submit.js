jQuery(function($) {
    $("#caag_form_init").submit();
    var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
    var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
    var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
    var safari_browser = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;

    /*Datepicker Setup*/
    /*
    var checkin = $('#pick_up_date').datepicker({
        format: "yyyy-mm-dd",
        ignoreReadonly: true
    }).on('changeDate', function (ev) {
        checkin.hide();
        var newDate = moment($("#pick_up_date").val(),"YYYY-MM-DD");
        $("#return_date").val(newDate.add(1,'week').format("YYYY-MM-DD"));
    }).data('datepicker');

    var checkout = $('#return_date_dummy').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        ignoreReadonly: true
    }).on('changeDate', function (ev) {

    }).data('datepicker');

    $("#pick_up_time").change(function(){
        $("#return_time").val($("#pick_up_time").val());
    });

    $("#pick_up_location").change(function(){
        $("#return_location").val($("#pick_up_location").val());
    });

    $("#pick_up_date").change(function(){
        var newDate = moment($("#pick_up_date").val(),"YYYY-MM-DD");
        $("#return_date").val(newDate.add(1,'week').format("YYYY-MM-DD"));
    });

    if(safari_browser) {
        //Menu
        $(".caag_safari > a").attr("href", "form-link");
        // Action on Book Form
        $("#caag_book_form").attr("action","form-link");
    }*/
});
