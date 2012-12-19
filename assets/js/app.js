$(document).ready(function(){

    $('*[rel=tooltip]').tooltip();

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

    $("#domain_group_add").live("click", function(){
        $("#domain_group_select").load("/groups/ajax_add");
    });

    $("#domain_group_add_cancel").live("click", function(){
        $("#domain_group_select").load("/groups/ajax_list");
    });

    $("#domain_group_add_submit").live("click", function(){
        $.ajax({
            url: "/groups/ajax_add",
            type: "post",
            data: "group_name=" + $("#domain_group_add_name").val(),
            success: function (data) {
                $("#domain_group_select").html(data);
            },
            error: function () {
                alert("An error occured!");
            }
        });
        return false;
    });

    $(".confirm").live("click", function() {
        $("span", this).html($(this).attr("data-confirm")).parent().removeClass("confirm");
        return false;
    });

    $("#domain_group_change").live("click", function(){
        $(this).parent().find("div.dropdown-menu div").load("/groups/ajax_list");
    });

//    $("div.domain_group_change").live("click", function(e) {
//        e.stopPropagation();
//    });

    $("#add_record").live("click", function(){
        $("#add_record_block").toggle();
    });

    $("#ar_type").change(function(){
        var type = $(this).val();
        if (type == "NS") {
            $("#ar_name").val("");
            $("#ar_name_block").hide();
            $("#ar_name_mask").show();
        } else {
            $("#ar_name_block").show();
            $("#ar_name_mask").hide();
        }
    });

    $("#add_record_block #ar_submit").click(function(){
        var ar_domain_name      = $("#add_record_block #ar_name_append").attr("rel");
        var ar_did              = $("#add_record_block #ar_did").val();
        var ar_name             = $("#add_record_block #ar_name").val();
        var ar_type             = $("#add_record_block #ar_type").val();
        var ar_content          = $("#add_record_block #ar_content").val();
        var ar_ttl              = $("#add_record_block #ar_ttl").val();
        var ar_priority         = $("#add_record_block #ar_priority").val();
        $.ajax({
            url: "/domains/add_record",
            type: "post",
            data: "domain_name="+ar_domain_name+"&did="+ar_did+"&name="+ar_name+"&type="+ar_type+"&content="+ar_content+"&ttl="+ar_ttl+"&priority="+ar_priority,
            dataType: "json",
            success: function(data){
                $("#add_record_block .control-group").removeClass("error").removeClass("success");
                if (data.status == 0) {
                    $.each(data.errors, function(i,v){
                        if (v != "") {
                            $("#add_record_block #ar_"+i).parent().addClass("error");
                        } else {
                            $("#add_record_block #ar_"+i).parent().addClass("success");
                        }
                    });
                } else {
                    location.href = "/domains/records/" + ar_did;
                }
            },
            error: function(){

            }
        });
    });

    $(".record_row .er_input").live("click", function(e){
        e.stopPropagation();
    });

    $(".record_row").hover(function(){
        if (!$(this).hasClass("record_edit_cancel"))
        $(this).find("td").css("background","#f1f5fa");
    },function(){
        if (!$(this).hasClass("record_edit_cancel"))
        $(this).find("td").css("background","#ffffff");
    });

    $(".record_edit .er_val").live("click", function(){
        var $this = $(this);
        setTimeout(function(){
            $this.parent().find("input.er_input").focus();
        },100);
    });

    $(".record_edit").live("click", function() {

        var record_row = $(this);

        $(".record_row td").css("background","#fff");
        $(".record_row td").find(".er_input").hide();
        $(".record_row td").find(".er_val").show();
        $(".record_row td").find(".record_save_btn").hide();
        $(".record_row td").find(".record_edit_btn").show();
        record_row.siblings(".record_row").removeClass("record_edit_cancel").addClass("record_edit");

        record_row.find("td").css("background","#e7eef7");
        record_row.css("box-shadow", "0 0 10px #aaa");

        record_row.removeClass("record_edit").addClass("record_edit_cancel");

        record_row.find(".record_edit_btn").hide();
        record_row.find(".record_save_btn").show();

        record_row.find(".er_input").show();
        record_row.find(".er_val").hide();

    });

    $(".record_edit_cancel").live("click", function(){

        var record_row = $(this);

        record_row.removeClass("record_edit_cancel").addClass("record_edit");

        record_row.find(".record_edit_btn").show();
        record_row.find(".record_save_btn").hide();

        record_row.find("td").css("background","inherit");
        record_row.find(".er_input").hide();
        record_row.find(".er_val").show();

    });

    $(".record_row_form").submit(function(){
        $.ajax({
            url: "/domains/edit_record",
            type: "POST",
            data: $(this).serialize(),
            success: function() {

            }
        });
        return false;
    });

    $(".select-input a").live("click", function(){
        var p = $(this).parent().parent().parent();
        var select_id = p.find(".select-input").attr("data-select-id");
        p.find(".select-label span").html($(this).html());
        $("#"+select_id).val($(this).attr("data-select-value"));
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