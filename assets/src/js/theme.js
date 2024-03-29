window.$ = window.jQuery = require("jquery");

function setActiveLogo(index) {
    $("#partners .logos .logo img").removeClass("border");
    $("#partners .logos .logo img").eq(index).addClass("border");
}

var swiper = new Swiper(".reviews-swiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    on: {
        init: function () {
            setActiveLogo(this.activeIndex);
        },
    },
});

swiper.on("slideChange", function () {
    setActiveLogo(swiper.activeIndex);
});

$(document).ready(function () {
    $("#offcanvas .nav li a").click(function () {
        $("#offcanvas button").click();
    });
});
