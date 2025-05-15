((e = {})["data-layout"] = sessionStorage.getItem("data-layout")),
(e["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size")),
(e["data-bs-theme"] = sessionStorage.getItem("data-bs-theme")),
(e["data-layout-width"] = sessionStorage.getItem("data-layout-width")),
(e["data-sidebar"] = sessionStorage.getItem("data-sidebar")),
(e["data-sidebar-image"] = sessionStorage.getItem("data-sidebar-image")),
(e["data-layout-direction"] = sessionStorage.getItem("data-layout-direction")),
(e["data-layout-position"] = sessionStorage.getItem("data-layout-position")),
(e["data-layout-style"] = sessionStorage.getItem("data-layout-style")),
(e["data-topbar"] = sessionStorage.getItem("data-topbar")),
(e["data-preloader"] = sessionStorage.getItem("data-preloader")),
(e["data-body-image"] = sessionStorage.getItem("data-body-image")),
(e["data-appColor"] = sessionStorage.getItem("data-appColor")), 
Object.keys(e).forEach(function(t) {
    e[t] && document.documentElement.setAttribute(t, e[t]);
});
