//const dropdown = document.querySelector('#myDropdown');
const dropdownToggle1 = document.querySelector('.dropbtn');
const dropdownContent = document.querySelector('.dropdown-content');
const dropdownToggle2 = document.querySelector('#navbar-icons');
const dropdownAccountContent = document.querySelector('#account');
const accountBtn = document.querySelector('.account-dropbtn');



// When the user clicks on the button, toggle between hiding and showing the dropdown content
function dropdownFunction(dropdownToggle,showToggle) {
    document.querySelector(dropdownToggle).classList.toggle(showToggle);

}

// Close the dropdown if the user clicks outside of it

document.addEventListener("click", (event) => {
    let isClickInside =  dropdownAccountContent.contains(event.target)|| accountBtn.contains(event.target);
    if (!isClickInside) {
        dropdownAccountContent.classList.remove("account-show");
    }
});


