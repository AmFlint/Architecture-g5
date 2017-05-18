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

/**** barre bleue au hover ******/
var tab = document.querySelector('.bar');
var lis = document.querySelectorAll('.li-active');

for (let i = 0; i < lis.length; i++) {

    lis[i].addEventListener('mouseover', function () {
        tab.style.left = this.offsetLeft - 4 + "px";
        tab.style.width = lis[i].offsetWidth + 10 + "px";
    });
}