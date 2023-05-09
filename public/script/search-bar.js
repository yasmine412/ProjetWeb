const searchButton = document.querySelector('#search-btn')
let windowPath = window.location.origin + '/homepage'
searchButton.addEventListener('click', () => {
    const locationInput = document.querySelector('#location')
    const locationValue = locationInput.value;
    const checkInInput = document.querySelector('#check-in')
    const checkInValue = checkInInput.value;
    const checkOutInput = document.querySelector('#check-out')
    const checkOutValue = checkOutInput.value;
    const guestInput = document.querySelector('#nbreVoyageurs')
    const guestValue = guestInput.textContent;

    if (locationValue) {
        windowPath = windowPath + `/location=${locationValue}`;
    }
    else {
        windowPath = windowPath + `/location= `;
    }
    if (checkInValue) {
        windowPath = windowPath + `/date_debut=${checkInValue}`;

    }
    else {
        windowPath = windowPath + `/date_debut= `;
    }
    if (checkOutValue) {
        windowPath = windowPath + `/date_fin=${checkOutValue}`;
    }
    else {
        windowPath = windowPath + `/date_fin= `;
    }
    if (guestValue) {
        windowPath = windowPath + `/nb_voyageurs=${guestValue}`;
    }
    else {
        windowPath = windowPath + `/nb_voyageurs= `;
    }
    window.location.href= windowPath;

});

