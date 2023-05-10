document.addEventListener('DOMContentLoaded', () => {

    const selectDrop = document.querySelector('#countries');
    fetch('https://restcountries.com/v3.1/all?fields=name,flags').then(res => {
        return res.json();
    }).then(countries => {

        const countryNames = countries.map(country => country.name.common);
        const sortedNames = countryNames.sort();
        let output = "";
        sortedNames.forEach(name => {
            output += ' <option value="'+name+'">'+name+'</option>';
        })

        selectDrop.innerHTML = output;
    }).catch(err => {
        console.log(err);
    })


});