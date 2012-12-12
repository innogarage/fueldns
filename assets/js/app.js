$(document).ready(function(){

    var tw = 0;
    var ww = $(".xfluid").width();

    $(".xfluid .xspan").each(function(i,e){
        var e = $(e);
        var w = e.attr("data-width");
        e.css("width",w);
        if (w != "extend-right") tw = tw + w;
        $(".xfluid div[data-width=extend-right]").css({"width": (ww - tw) + "px", "left": tw + "px"});
    });

});


$(window).resize(function () {

    var tw = 0;
    var ww = $(".xfluid").width();

    $(".xfluid .xspan").each(function(i,e){
        var e = $(e);
        var w = e.attr("data-width");
        e.css("width",w);
        if (w != "extend-right") tw = tw + w;
        $(".xfluid div[data-width=extend-right]").css({"width": (ww - tw) + "px", "left": tw + "px"});
    });

});