const coeur = document.getElementById('coeur');

coeur.addEventListener('click', function() {
    coeur.src = '../assets/heart-fill.svg';
});



const dropdown = document.querySelector('#myDropdown');
const dropdownToggle1 = document.querySelector('.dropbtn');
const dropdownContent = document.querySelector('.dropdown-content');
const dropdownToggle2 = document.querySelector('.account-dropbtn');
const dropdownAccountContent = document.querySelector('.dropdown-account-content');


// When the user clicks on the button, toggle between hiding and showing the dropdown content
function dropdownFunction(dropdownToggle,showToggle) {
    document.querySelector(dropdownToggle).classList.toggle(showToggle);
}

// Close the dropdown if the user clicks outside of it
document.addEventListener("click", (event) => {
    if (event.target !== dropdownToggle1 && event.target.closest(".dropdown-content") !== dropdownContent) {
        dropdownContent.classList.remove("show");
    }
});


document.addEventListener("click", (event) => {
    if (event.target !== dropdownToggle2 && event.target.closest(".dropdown-account-content") !== dropdownAccountContent) {
        dropdownContent.classList.remove("account-show");
    }
});

totalValue = 0;
const decrementBtns = document.querySelectorAll(".decrement-btn");
const incrementBtns = document.querySelectorAll(".increment-btn");




function increment(inputField,inputClass) {
    const voyageur=document.querySelector('#voyageur-value');
    const input = document.querySelector(inputField);
    const decrementBtn = document.querySelector(".decrement-btn"+inputClass);
    const incrementBtn = document.querySelector(".increment-btn"+inputClass);

    let voy=parseInt(voyageur.textContent);
    let inputValue = parseInt(input.textContent);
    if (totalValue<16) {
        inputValue++;
        voy++;
        totalValue++;
        voyageur.textContent=voy;
        input.textContent = inputValue;
        decrementBtn.disabled = false;

    }

    if (totalValue==16) {
        incrementBtn.disabled = true;
        console.log("Hello from disable button")
    }
    console.log(incrementBtns)

}

function decrement(inputField,inputClass) {
    const voyageur=document.querySelector('#voyageur-value');
    const input = document.querySelector(inputField);
    const decrementBtn = document.querySelector(".decrement-btn"+inputClass);
    const incrementBtn = document.querySelector(".increment-btn"+inputClass);
    let inputValue = parseInt(input.textContent);
    let voy=parseInt(voyageur.textContent);
    if (inputValue > 0) {
        inputValue--;
        voy--;
        totalValue--;
        input.textContent = inputValue;
        voyageur.textContent=voy;
        incrementBtn.disabled=false;
        if ((inputValue==0)||(totalValue==0)) {
            decrementBtn.disabled = true;
        }

    }
    else {
        decrementBtn.disabled = true;
    }

}

/*(document).ready(function() {
   const EnSav = document.querySelector(".en-savoir-plus");
   const Text = document.querySelector(".texte-complet");
   EnSav.click(function() {
      Text.show();
   });
});*/




// en savoir plus
const btnEnSavoirPlus = document.getElementById('btn-en-savoir-plus');
const texteComplet = document.getElementById('texte-complet');

btnEnSavoirPlus.addEventListener('click', function() {
    texteComplet.style.display = 'block';
    btnEnSavoirPlus.style.display = 'none';
});




/* pour le bouton qui affiche tous les aquipements */
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("open-modal");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}



// When the user clicks anywhere outside of the modal, close it
/*window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/





/* pour le bouton qui affiche tous les aquipements */
// Get the modal
var modal1 = document.getElementById("myModal1");

// Get the button that opens the modal
var btn1 = document.getElementById("open-modal1");

// Get the <span> element that closes the modal
/*var span1 = document.getElementsByClassName("close")[1];

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}

 */
// When the user clicks the button, open the modal
btn1.onclick = function() {
    modal1.style.display = "block";
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal1) {
        modal1.style.display = "none";
    }

}





//commentaire
const commentTextarea = document.querySelector('#floatingTextarea2');
const submitBtn = document.querySelector('btn-outline-secondary');

commentTextarea.addEventListener('keyup', () => {
    if (commentTextarea.value.trim() === '') {
        submitBtn.disabled = true;
    } else {
        submitBtn.disabled = false;
    }
});




/* calendrier personalisé

$(document).ready(function() {
    $('#calendar').fullCalendar({
        selectable: true,
        selectHelper: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        eventRender: function(event, element) {
            if (event.available == false) {
                element.css('text-decoration', 'line-through');
                element.css('color', '#9e9e9e');
                element.draggable = false;
            }
        },
        events: [
            {
                title: 'Disponible',
                start: '2023-05-01',
                end: '2023-05-03',
                available: true
            },
            {
                title: 'Non disponible',
                start: '2023-05-05',
                end: '2023-05-07',
                available: false
            }
        ]
    });
});*/


// le clique sur le boutton reserver
function redirectToReservationController() {
    window.location.href = "/reservation";
}