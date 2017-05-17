


/***** carrousel ******/

var slider = document.querySelectorAll('.slider-bar');
var actus = document.querySelectorAll('.carrousel-actu [class*="-actu"]');
var fullImg = document.querySelector('.full-img');
var index_nav_slider = 0;
var index_carousel_actu = 0;
for (let i = 0; i < slider.length; i++) {
    slider[i].addEventListener('click', function() {
        var index_previous = index_carousel_actu;
        index_carousel_actu = i;
        console.log(i);
        renderCover(actus, index_carousel_actu, index_previous);
        slider[index_previous].style.background = '#fff';
        slider[i].style.background = '#15D1E7';
    });
}


// Carousel revues / Magazines
setTimeout(init, 500);
var next = document.querySelector('.next');
var prev = document.querySelector('.prev');
var index_revues = 0;

prev.addEventListener('click', function() {
    var index_previous = index_revues;
    index_revues--;
    if (index_revues < 0) {
        index_revues = 7;
    }
    renderCover(revues_couverture, index_revues, index_previous);
    renderCover(revues_infos, index_revues, index_previous);
});

next.addEventListener('click', function() {
    var index_previous = index_revues;
    index_revues++;
    if (index_revues > 7) {
        index_revues = 0;
    }
    renderCover(revues_couverture, index_revues, index_previous);
    renderCover(revues_infos, index_revues, index_previous);
});


function init()
{
    window.revues_couverture = document.querySelectorAll('.couvertures div');
    window.revues_infos = document.querySelectorAll('.cover-infos');
}

function renderCover(array_revue, index_new, index_previous)
{
    array_revue[index_previous].classList.remove('visible');
    array_revue[index_new].classList.add('visible');
}