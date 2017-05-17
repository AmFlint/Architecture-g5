/**** filtres page commande ****/

var euros = document.querySelector('.euro');
var swiss = document.querySelector('.swiss');
var filtre = document.querySelectorAll('.tab span');

filtre[0].addEventListener('click', function() {
    euros.style.display = 'block';
    swiss.style.display = 'none';

});
filtre[1].addEventListener('click', function() {
    euros.style.display = 'none';
    swiss.style.display = 'block';

});

