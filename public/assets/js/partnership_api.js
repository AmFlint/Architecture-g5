console.log('hello');

setTimeout(function() {
    window.lis = document.querySelectorAll('.partner_available li');
    for(let i = 0; i < lis.length; i++) {
        lis[i].addEventListener('click', function() {
            console.log(this.dataset.id);
            console.log(this.dataset.mag);
            loadFile('http://localhost:8888/admin/magazines/' + this.dataset.mag + '/' +this.dataset.id);
        });
    }
}, 1000);


function loadFile(page)
{
    var xhr = new XMLHttpRequest();
    xhr.open("GET", page, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {

        }
    };
    xhr.send();
}

function readData(xhr)
{
    magazines = JSON.parse(xhr.response);
    render();
}



