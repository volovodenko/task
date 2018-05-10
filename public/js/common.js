$(function () {
    var regLink = document.getElementById("regLink"),
        loginLink = document.getElementById("loginLink");


    if (regLink) {
        regLink.addEventListener("click", function () {
            if ($("#regForm").css("display") != "block") {
                $("#regForm").offset({top: 50});
                $("#regForm").slideDown();
            } else {
                $("#regForm").slideUp();
            }

        });
    }


    if (loginLink) {
        loginLink.addEventListener("click", function () {
            if ($("#loginForm").css("display") != "block") {
                $("#loginForm").offset({top: 50});
                $("#loginForm").slideDown();
            } else {
                $("#loginForm").slideUp();
            }
        });
    }


    $(document).mouseup(function (e) {
        var elem = $(".collapse");

        if (!elem.is(e.target)
            && elem.has(e.target).length === 0) {
            elem.slideUp();
        }

    });
});