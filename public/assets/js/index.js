


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