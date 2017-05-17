setTimeout(function() {
    window.buttons = document.querySelectorAll('aside li');

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function() {
            console.log(this.innerHTML);
            var to_send = this.innerHTML.split(' ').join('_');
            loadFile('/api/revue/' + to_send);
        });
    }
}, 500);

var app = document.querySelector('.listing_mags');


function loadFile(page)
{
    var xhr = new XMLHttpRequest();
    xhr.open("GET", page, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            readData(xhr);
        }
    };
    xhr.send();
}

function readData(xhr)
{
    magazines = JSON.parse(xhr.response);
    render();
}

function render()
{
    app.innerHTML = '';
    for (let i = 0; i < magazines.length; i++) {
        let article = document.createElement('article');
        article.innerHTML =
            '<a href="/revue/'+ magazines[i].id +'">' +
                '<figure>' +
                    '<img src="assets/img-content/' + magazines[i].image + '" alt="">' +
                    '<div class="hover">' +
                        '<img src="assets/img-layout/plus.svg" alt="">' +
                    '</div>' +
            '   </figure>' +
            '<p>'+magazines[i].location+'</p>'
        ;
        app.appendChild(article);
    }
}
