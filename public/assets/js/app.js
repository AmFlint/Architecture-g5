var mail = document.querySelector('input[type=email]'),
    submit = document.querySelector('input[type=submit]'),
    inputs = document.querySelectorAll('input'),
    textareaForm = document.querySelector('textarea'),
    form =  document.querySelector('form');

function validateEmail(mail) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(mail);
}


form.addEventListener('submit', function (event) {
    event.preventDefault();

    for (var i = 0 ; i < inputs.length ; i++) {
        if (inputs[i].value.trim() == "") {
            return
        }
    }

    if (textareaForm.value.trim() == "") {
        return
    }

    if (!validateEmail(mail.value)) {
        return
    }
    form.submit();
});
