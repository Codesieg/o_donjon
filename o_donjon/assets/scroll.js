// Module de gestion du slide sur la page home

const scroll = {

    init: function() {

        let scrollElementsList = document.querySelectorAll('.scroll');
        for (let scrollElement of scrollElementsList) {
            scrollElement.addEventListener('scroll', scroll.myLastScrollTo(scrollElement));
            console.log(scrollElement);
        }

    },

    myLastScrollTo: function(scrollElement) {
        location.hash = "#" + scrollElement.id;
        console.log(location.hash);

    },

    myScrollTo: function(id) {
        var e = document.getElementById(id);
        var box = e.getBoundingClientRect();
        var k, inc;
        inc = (box.top >= 0) ? 1 : -1;
        for (k = 0; k < 49; k++) setTimeout("window.scrollBy(0," + Math.floor(box.top / 50) + ")", 10 * k);
        setTimeout("myLastScrollTo('" + id + "')", 500);
    },
}

document.addEventListener('DOMContentLoaded', scroll.init);

console.log('%c' + 'scroll.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');