/* ! function(a, b, c) {
    var d, e, f;
    f = "PIN_" + ~~((new Date).getTime() / 864e5), a[f] || (a[f] = !0, a.setTimeout(function() {
        d = b.getElementsByTagName("SCRIPT")[0], e = b.createElement("SCRIPT"), e.type = "text/javascript", e.async = !0, e.src = c + "?" + f, d.parentNode.insertBefore(e, d)
    }, 10))
}(window, document, "//assets.pinterest.com/js/pinit_main.js"); */

! function(a, b, c) {
    var d, e, f;
    f = "PIN_" + ~~((new Date).getTime() / 864e5), a[f] || (a[f] = !0, a.setTimeout(function() {
        d = b.getElementsByTagName("SCRIPT")[0], e = b.createElement("SCRIPT"), e.type = "text/javascript", e.async = !0, e.src = c, d.parentNode.insertBefore(e, d)
    }, 10))
}(window, document, "//assets.pinterest.com/js/pinit_main.js");