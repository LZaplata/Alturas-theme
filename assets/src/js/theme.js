window.$ = window.jQuery = require("jquery");

var swiper = new Swiper(".reviews-swiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});

$(document).ready(function () {
    $("#offcanvas .nav li a").click(function () {
        $("#offcanvas button").click();
    });
});
