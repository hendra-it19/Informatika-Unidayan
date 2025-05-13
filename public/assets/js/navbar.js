window.onscroll = function () {
    scrollFunction();
    sidebarScroll();
    // console.log(document.documentElement.clientWidth);
};

function scrollFunction() {
    if (
        document.body.scrollTop > 80 ||
        document.documentElement.scrollTop > 80
    ) {
        document.getElementById("navbar-container").style.position = "sticky";
        // document.getElementById("navbar-container").style.padding = "0px 0px";
        document.getElementById("navbar-container").style.padding = "6px 0px";
        document.getElementById("navbar-container").style.boxShadow =
            "4px 0px 0px 1.5px rgba(0,0,0,0.1)";
        document.getElementById("navbar-container").style.backgroundColor =
            "white";
        document.getElementById("button-scroll-top").style.bottom = "60px";
    } else {
        document.getElementById("navbar-container").style.position = "relative";
        // document.getElementById("navbar-container").style.padding = "10px 0px";
        document.getElementById("navbar-container").style.padding = "0px 0px";
        document.getElementById("navbar-container").style.boxShadow = "";
        document.getElementById("navbar-container").style.backgroundColor =
            "transparent";
        document.getElementById("button-scroll-top").style.bottom = "-40px";
    }
}

function sidebarScroll() {
    const sidebar = document.getElementById("sidebar");
    const footer = document.getElementById("footer");
    const width = window.innerWidth;
    var space = window.innerHeight - sidebar.offsetTop + sidebar.offsetHeight;
    var sidebarTop = sidebar.offsetTop;
    var footerTop = footer.offsetTop;
    var distance = footerTop - sidebarTop;
    if (
        (document.body.scrollTop >= 300 && width >= 1000) ||
        (document.documentElement.scrollTop >= 300 && width >= 1000)
    ) {
        sidebar.style.position = "fixed";
        sidebar.style.top = "90px";
        sidebar.style.width = "fit-content";
    } else {
        sidebar.style.position = "relative";
        sidebar.style.top = "0px";
        sidebar.style.width = "100%";
    }
}

function toTopFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
