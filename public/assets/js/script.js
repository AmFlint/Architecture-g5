/**** barre bleue au hover ******/
var tab = document.querySelector('.bar');
var lis = document.querySelectorAll('.li-active');

for (let i = 0; i < lis.length; i++) {

    lis[0].addEventListener('mouseover', function () {
        tab.style.left = '2%';
    });
    lis[1].addEventListener('mouseover', function () {
        tab.style.left = '12%';
    });
    lis[2].addEventListener('mouseover', function () {
        tab.style.left = '23%';
    });
    lis[3].addEventListener('mouseover', function () {
        tab.style.left = '67%';
    });
    lis[4].addEventListener('mouseover', function () {
        tab.style.left = '80%';
    });
    lis[5].addEventListener('mouseover', function () {
        tab.style.left = '91%';
    });
}


/**** changement nav ******/
var nav = document.querySelector('.main-nav');
var logo = document.querySelector('.logo');
var lesa = document.querySelectorAll('nav a');

document.addEventListener('scroll', function (event) {
    if (document.body.scrollTop > 80 || event.pageY > 80) {
        nav.classList.add('colornav');
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

/**** changement infos sur les parutions ******/

var mag = document.querySelectorAll('.couvertures div');
var info = document.querySelector('.cover-infos p');
var edition = document.querySelector('span.edition');


for (var i = 0; i < mag.length; i++) {
    mag[0].addEventListener('mouseover', function () {
        info.innerHTML = "Guadeloupe";
    });
    mag[1].addEventListener('mouseover', function () {
        info.innerHTML = "Alsace";
    });
    mag[2].addEventListener('mouseover', function () {
        info.innerHTML = "Belgique";
    });
    mag[3].addEventListener('mouseover', function () {
        info.innerHTML = "Suisse";
    });
    mag[4].addEventListener('mouseover', function () {
        info.innerHTML = "Centre";
    });
    mag[5].addEventListener('mouseover', function () {
        info.innerHTML = "Rhône-Alpes";
    });
    mag[6].addEventListener('mouseover', function () {
        info.innerHTML = "Bretagne/Normandie";
    });
    mag[7].addEventListener('mouseover', function () {
        info.innerHTML = "Île-de-France";
        edition.innerHTML = "2016";
    });
    mag[8].addEventListener('mouseover', function () {
        info.innerHTML = "Martinique";
        edition.innerHTML = "2017";
    });

}

/****burger ****/

var burger = document.querySelector('.burger');
var menu = document.querySelector('.menu-burger');
var ul = document.querySelector('.menu-burger ul');
var cross = document.querySelector('.cross');

burger.addEventListener('click', function() {
    menu.classList.toggle('active');
    ul.style.transform = 'translateX(0)';
});

cross.addEventListener('click', function() {
    menu.classList.add('active');
});

/***** carrousel ******/

var slider = document.querySelectorAll('.slider-bar');
var actus = document.querySelectorAll('.carrousel-actu div');
var fullImg = document.querySelector('.full-img');

for (var i = 0; i < slider.length; i++) {
    slider[0].addEventListener('click', function () {
        actus[0].style.display = 'block';
        actus[1].style.display = 'none';
        actus[2].style.display = 'none';
        actus[3].style.display = 'none';
        slider[0].style.background = '#15D1E7';
        slider[1].style.background = '#fff';
        slider[2].style.background = '#fff';
        slider[3].style.background = '#fff';
        fullImg.style.background = "url('assets/img-content/actu-1.png')";
    });
    slider[1].addEventListener('click', function () {
        actus[0].style.display = 'none';
        actus[1].style.display = 'block';
        actus[2].style.display = 'none';
        actus[3].style.display = 'none';
        slider[1].style.background = '#15D1E7';
        slider[2].style.background = '#fff';
        slider[3].style.background = '#fff';
        slider[0].style.background = '#fff';
        fullImg.style.background = "url('assets/img-content/actu-2.png')";
    });
    slider[2].addEventListener('click', function () {
        actus[2].style.display = 'block';
        actus[1].style.display = 'none';
        actus[0].style.display = 'none';
        actus[3].style.display = 'none';
        slider[2].style.background = '#15D1E7';
        slider[3].style.background = '#fff';
        slider[1].style.background = '#fff';
        slider[0].style.background = '#fff';
        fullImg.style.background = "url('assets/img-content/actu-3.png')";
    });
    slider[3].addEventListener('click', function () {
        actus[3].style.display = 'block';
        actus[2].style.display = 'none';
        actus[1].style.display = 'none';
        actus[0].style.display = 'none';
        slider[3].style.background = '#15D1E7';
        slider[2].style.background = '#fff';
        slider[0].style.background = '#fff';
        slider[1].style.background = '#fff';
        fullImg.style.background = "url('assets/img-content/actu-4.png')";

    });
 }