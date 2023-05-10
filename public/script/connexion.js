document.querySelector('#compte_Email').addEventListener('blur', validateEmail);
document.querySelector('#compte_Password').addEventListener('blur', validatePassword);
document.querySelector('.btn1').addEventListener('click', validateEmail);
document.querySelector('.btn1').addEventListener('click', validatePassword);


const reSpaces = /^\S*$/;



function validateEmail() {
    const email = document.querySelector('#compte_Email');
    const re = /^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/;

    if (reSpaces.test(email.value) && re.test(email.value)) {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');

        return true;
    } else {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');

        return false;
    }
}

function validatePassword() {
    const password = document.querySelector('#compte_Password');
    const re = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})(?=.*[!@#$%^&*])/;
    if (re.test(password.value) && reSpaces.test(password.value)) {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');

        return true;
    } else {
        password.classList.add('is-invalid');
        password.classList.remove('is-valid');

        return false;
    }
}

(function () {
    const forms = document.querySelectorAll('.needs-validation');

    for (let form of forms) {
        form.addEventListener(
            'submit',
            function (event) {
                if (
                    !form.checkValidity() ||
                    !validateEmail() ||
                    !validatePassword()
                ) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    form.classList.add('was-validated');
                }
            },
            false
        );
    }
})();

function connexionModalOpened() {
    var currentPath = window.location.pathname;
    window.history.pushState(null,null,currentPath+"/login");
}

document.querySelector('.btn-cnx').addEventListener('click',function(){window.onclick=function (event) {
    const modal = document.querySelector('#myModal1');
    setTimeout(function () {
        if (!modal.classList.contains("show")) {
            var currentPath = window.location.pathname;
            const newUrl = currentPath.replace('/login', '');
            window.history.pushState(null, null, newUrl);
        }
    }, 150);
}})




function connexioncloseModal() {
    var currentPath = window.location.pathname;
    const newUrl = currentPath.replace('/login', '');
    window.history.pushState(null, null, newUrl);
}