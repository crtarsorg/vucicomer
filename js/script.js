$(function () {
    $('.summary > div > h2 > b').html(
        Math.ceil((new Date() - new Date(2014,4,27))/(1000*60*60*24))
        );
})

$(document).ready(function () {
    $(window).scroll(function () {
        if (document.documentElement.scrollTop || document.body.scrollTop) {
            $("header").addClass("solid")
        } else {
            $("header").removeClass("solid")
        }
    });
});

if (window.location.pathname == "/") {
    $.getScript("js/index.js");
}