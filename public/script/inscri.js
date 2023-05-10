document.querySelector('#compte_Email').addEventListener('blur', validateEmail);
document.querySelector('#compte_Password').addEventListener('blur', validatePassword);
document.querySelector('#compte_Telephone').addEventListener('blur', validatePhone);
document.querySelector('#compte_DateNaissance').addEventListener('blur', validateAge);
document.querySelector('#compte_Nom').addEventListener('blur', validateNom);
document.querySelector('#compte_Prenom').addEventListener('blur', validatePrenom);


document.querySelector('.btn2').addEventListener('click', validateEmail);
document.querySelector('.btn2').addEventListener('click', validatePassword);
document.querySelector('.btn2').addEventListener('click', validateAge);
document.querySelector('.btn2').addEventListener('click', validatePhone);
document.querySelector('.btn2').addEventListener('click', validateNom);
document.querySelector('.btn2').addEventListener('click', validatePrenom);





function validateNom(){
    const s=document.querySelector('#compte_Nom');
    const name=s.value.trim();
    const re=/^[a-zA-ZÀ-ÿ]+(([',. -][a-zA-ZÀ-ÿ ])?[a-zA-ZÀ-ÿ]*)*$/;

    if(re.test(name)){
        s.classList.remove('is-invalid');
        s.classList.add('is-valid');

        return true;
    }
    else {
        s.classList.remove('is-valid');
        s.classList.add('is-invalid');

        return false;
    }
}


function validatePrenom(){
    const firstname=document.querySelector('#compte_Prenom');
    const re=/^[a-zA-ZÀ-ÿ]+(([',. -][a-zA-ZÀ-ÿ ])?[a-zA-ZÀ-ÿ]*)*$/;
    if(re.test(firstname.value)){
        firstname.classList.remove('is-invalid');
        firstname.classList.add('is-valid');
        return true;
    }else {
        firstname.classList.remove('is-valid');
        firstname.classList.add('is-invalid');
        return false;

    }
}

function validateEmail(e) {
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
   const  password = document.querySelector('#compte_Password');
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
function validatePhone(){
    const tel=document.querySelector('##compte_Telephone');
    const re=/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if(re.test(tel.value)){
        tel.classList.remove('is-invalid');
        tel.classList.add('is-valid');

        return true;

    }else {
        tel.classList.add('is-invalid');
        tel.classList.remove('is-valid');

        return false;

    }
}
function calculAge(){
    const userinput = document.getElementById("#compte_DateNaissance").value;
    const dob = new Date(userinput);
    if(userinput==null || userinput==='') {
        return false;
    } else {

        //calculate month difference from current date in time
        const month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format
        const age_dt = new Date(month_diff);

        //extract year from date
        const year = age_dt.getUTCFullYear();

        //now calculate the age of the user
        const age = Math.abs(year - 1970);

        //display the calculated age
        return (age) ;
    }
}
function  validateAge() {
    const Age1 = document.querySelector('#compte_DateNaissance');
    const dob = new Date(Age1.value);
    if (Age1.value == null || Age1.value === '') {
        return false;
    } else {

        //calculate month difference from current date in time
        const month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format
        const age_dt = new Date(month_diff);

        //extract year from date
        const year = age_dt.getUTCFullYear();

        //now calculate the age of the user
        const age = Math.abs(year - 1970);


        if (age >= 18) {
            Age1.classList.add('is-valid');
            Age1.classList.remove('is-invalid');
            return true;
        } else {
            Age1.classList.add('is-invalid');
            Age1.classList.remove('is-valid');
            return false;

        }
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
                    !validatePassword() ||
                    !validatePhone() ||
                    !validateAge()||
                    !validateNom() ||
                    !validatePrenom()
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

// Get a reference to your modal element


function inscriptionModalOpened() {
    var currentPath = window.location.pathname;
    window.history.pushState(null,null,currentPath+"/inscription");
}

document.querySelector('.btn-inscri').addEventListener('click',function(){window.onclick=function (event) {
    const modal = document.querySelector('#myModal2');
    setTimeout(function () {
        if (!modal.classList.contains("show")) {
            var currentPath = window.location.pathname;
            const newUrl = currentPath.replace('/inscription', '');
            window.history.pushState(null, null, newUrl);
        }
    }, 150);
}})




function inscriptioncloseModal() {
    var currentPath = window.location.pathname;
    const newUrl = currentPath.replace('/inscription', '');
    window.history.pushState(null, null, newUrl);
}


