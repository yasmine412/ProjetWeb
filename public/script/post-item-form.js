(function () {
    'use strict'
    const forms = document.querySelectorAll('.requires-validation')
    Array.from(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()


document.addEventListener('DOMContentLoaded', () => {

    const selectDrop = document.querySelector('#countries');
    fetch('https://restcountries.com/v3.1/all?fields=name,flags').then(res => {
        return res.json();
    }).then(countries => {

        const countryNames = countries.map(country => country.name.common);
        const sortedNames = countryNames.sort();
        let output = "";
        sortedNames.forEach(name => {
            console.log(name)
            output += ' <option value="'+name+'">'+name+'</option>';
        })

        selectDrop.innerHTML = output;
    }).catch(err => {
        console.log(err);
    })


});


document.addEventListener('DOMContentLoaded', () => {
    const SelectNumber =document.querySelector('#numero');
    let outputnumber="";
    for(let i=1;i<201;i++)
    {
         outputnumber +='<option value="'+i+'">'+i+'</option>'

    }
    SelectNumber.innerHTML=outputnumber;

});

function increment(inputField) {

    const input = document.querySelector(inputField + "-value");
    const decrementBtn = document.querySelector(inputField + "-decrement");
    const incrementBtn = document.querySelector(inputField + "-increment");

    let inputValue = parseInt(input.textContent);
    if (inputValue < 50) {
        inputValue++;
        input.textContent = inputValue;
        decrementBtn.disabled = false;
        decrementBtn.style.cursor='pointer' ;


    }

    if (inputValue == 50) {
        incrementBtn.disabled = true;
        decrementBtn.style.cursor='not-allowed' ;
    }

}

function decrement(inputField) {

    const input = document.querySelector(inputField + "-value");
    const decrementBtn = document.querySelector(inputField + "-decrement");
    const incrementBtn = document.querySelector(inputField + "-increment");

    let inputValue = parseInt(input.textContent);
    if (inputValue > 0) {
        inputValue--;
        input.textContent = inputValue;
        incrementBtn.disabled = false;
        decrementBtn.style.cursor='pointer' ;

    }


    if (inputValue == 0) {
        decrementBtn.disabled = true;
        decrementBtn.style.cursor='not-allowed' ;
    }

}


// Create our number formatter.
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
});

document.querySelector('#typeNumber').addEventListener('change', (e) => {
    if (isNaN(e.target.value)) {
        e.target.value = ''
    } else {
        e.target.value = formatter.format(e.target.value);
    }
})
