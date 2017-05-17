var nav = document.querySelector('.main-nav');
var logo = document.querySelector('.logo');
var lesa = document.querySelectorAll('nav a');

document.addEventListener('scroll', function (event) {
    if (document.body.scrollTop > 80 || event.pageY > 80) {
        nav.classList.add('colornav');
        nav.style.position = 'fixed';
        tab.style.background = '#fff';
        logo.src = "assets/img-layout/black-logo.svg";
        for (var i = 0; i < lesa.length; i++) {
            lesa[i].style.color = "#000";

        }

    } else if (document.body.scrollTop < 80 || event.pageY < 80) {
        nav.classList.remove('colornav');
        tab.style.background = '#15D1E7';
        logo.src = "assets/img-layout/logo.svg";
        for (var i = 0; i < lesa.length; i++) {
            lesa[i].style.color = "#fff";
        }

    }
});

/**** barre bleue au hover ******/
var tab = document.querySelector('.bar');
var lis = document.querySelectorAll('.li-active');

for (let i = 0; i < lis.length; i++) {

    lis[i].addEventListener('mouseover', function () {
        tab.style.left = this.offsetLeft - 4 + "px";
        tab.style.width = lis[i].offsetWidth + 10 + "px";
    });
}

/****burger ****/

var burger = document.querySelector('.burger');
var menu = document.querySelector('.menu-burger');
var cross = document.querySelector('.cross');

burger.addEventListener('click', function() {
    menu.classList.toggle('active');
});

cross.addEventListener('click', function() {
    menu.classList.add('active');
});
