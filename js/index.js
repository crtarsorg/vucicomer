/*
Copyright (c) 2015, Covosoft Corp.
This code and information are provided "as is" without warranty of any kind, either expressed or implied. In no event shall the authors be liable for any claim, damages or other liability arising from, out of or in connection with this site or its use.
Author: Dom Bernard
Email: contact@covosoft.com
Date: 01-Nov-2015
*/

$(document).ready(function () {

    $(".summary a div").on("click", function () {
        $(".search input").val($(this).data("search")).change()
    });

    $("input[type=search]").on("keyup search input paste cut change", function () {
        var filter = $(this).val();
        count = 0;
        $("tr").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide()
            } else {
                $(this).show()
                count++;
            };
        });

        if ($(this).val()) {
            $(".search button").show();
            $(".tabs").addClass("inactive");
            if (count == 1) {
                $("#count").html("1 match")
            } else {
                $("#count").html(count + " matches")
            };
        } else {
            $(".search button").hide();
            $(".tabs").removeClass("inactive");
            $("#count").empty();
            $("tr").hide();
            $("tr." + $(".selected").attr("class").split(" ")[0]).show();
        };
    });

    $(".search button").on("click", function () {
        $(".search input").val("").change()
    });

    $(".tabs a").on("click", function () {
        if (!$(this).parent().hasClass("inactive")) {
            if (!$(this).hasClass("selected")) {
                $(".tabs a").removeClass("selected");
                $(this).addClass("selected");
                $("tr").each(function () {
                    if ($(this).hasClass($(".selected").attr("class").split(" ")[0])) {
                        $(this).show()
                    } else {
                        $(this).hide()
                    }
                });
            };
        };
    });

});

$(window).load(function () {

    var grandtotal = $("tr.promise").length;

    $(".summary b.count").each(function () {
        $(this).html($("tr." + $(this).closest("div").attr("class")).length)
    });

    $(".summary b.total").each(function () {
        $(this).html(grandtotal)
    });

    $(".summary p.progress span").each(function () {
        $(this).css("width", ($("tr." + $(this).closest("div").attr("class")).length * 100 / grandtotal) + "%")
    });

    $("tr.category b").each(function () {
        $(this).html($("tr." + $(this).parent().attr("class") + "." + $(this).attr("class")).length)
    });

    $("tr.category p.progress span").each(function () {
        var total = $("tr.promise." + $(this).parent().parent().children("b").attr("class")).length;
        $(this).css("width", ($("tr." + $(this).parent().parent().attr("class") + "." + $(this).parent().parent().children("b").attr("class")).length * 100 / total) + "%")
    });

    

});