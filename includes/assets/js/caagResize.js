iFrameResize({
    log: false,
    checkOrigin: false,
    maxWidth: screen.width,
    sizeWidth: true,
    resizedCallback: function(message) {
        var height = document.getElementById('caag-rental-iframe').clientHeight;
        var newheight = height * 1.1;
        document.getElementById("caag-rental-iframe").style.height = newheight + "px";
    }
}, '#caag-rental-iframe');