$(document).ready(function(){

    var tw = 0;
    var ww = $(".xfluid").width();
    var wh = $(window).height();
    var nh = $(".navbar").height();

    var dlt = $(".domain-listing-nav").offset().top;

    if ($(".domain-records-table").length > 0) {
        var drt = $(".domain-records-table").offset().top;
        $(".domain-records-table").height(wh - drt);
    }

    $(".domain-listing-nav").height(wh - dlt);

    $(".xfluid .xspan").each(function(i,e){
        var e = $(e);
        var w = e.attr("data-width");
        e.css({"width": w + "px","height": (wh - nh) + "px"});
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