const numberBoxes = document.querySelectorAll('.number-boxes');
const type = document.querySelectorAll('.type');
const price = document.querySelector('#price');
const affiche = document.querySelector('#prix-affiche');
const valider = document.querySelector('#validation');
let windowPathSub = window.location.origin + '/homepage';
const type_propriete = document.querySelector('.type-propriete');
let logement = document.querySelector('input[type="radio"]:checked');
let nb = 0;

// Add click event listener to each box

numberBoxes.forEach(box => {
  const spans = box.querySelectorAll('span');
  spans.forEach(span => {
    span.addEventListener('click', () => {
      // Remove the "selected" class from all other spans in the same group
      spans.forEach(otherSpan => {
        otherSpan.classList.remove('selected');
      });
      span.classList.add('selected');

    });
  });
});

type.forEach(box => {
  box.addEventListener('click', () => {
    type.forEach(otherBox => {
        if (box !== otherBox) {
            otherBox.classList.remove('selected-type');
        }
    })
      if (box.classList.contains('selected-type')) {
          box.classList.remove('selected-type');
      }
      else {
          box.classList.add('selected-type');
      }

  })
})
function showMore(btnId,additionalItemsContainerId) {

  const showMoreBtn = document.querySelector(btnId);
  const additionalItemsContainer = document.querySelector(additionalItemsContainerId);

  additionalItemsContainer.classList.toggle("hide");
  let isAdditionalItemsVisible = additionalItemsContainer.classList.contains("hide");

  showMoreBtn.textContent = isAdditionalItemsVisible ? "Afficher plus d'options" : "Afficher moins d'options";
}
price.addEventListener('input', () => {
  affiche.innerHTML ="<b>"+ price.value+ " $</b>";
})

valider.addEventListener('click', () => {
    if (window.location.pathname === '/homepage') {
        windowPathSub = windowPathSub + "/filtres&"
    }
    else if (window.location.pathname.includes('/filtres&')) {
        let position = window.location.pathname.indexOf("/filtres&");
        windowPathSub = window.location.origin + window.location.pathname.slice(0, position) + "/filtres&";
    }
    else {
        windowPathSub = window.location.origin + window.location.pathname + "/filtres&"
    }
    logement = document.querySelector('input[type="radio"]:checked');
    if (logement) {
        windowPathSub = windowPathSub + 'prix=' + price.value + '&type_logement=' + logement.value;
    }
    else {
        windowPathSub = windowPathSub + 'prix=' + price.value + '&type_logement= ';
    }
    numberBoxes.forEach(box => {
        const spans = box.querySelectorAll('span');
        spans.forEach(span => {
            if (span.classList.contains('selected')) {
                if (span.textContent === '8+') {
                    nb=8;
                }
                else {
                    nb = span.textContent;
                }
                windowPathSub = windowPathSub + '&'+box.id+'=' + nb;

            }
        });
    })
    let prop = type_propriete.querySelector('.selected-type')
    if (prop) {
        windowPathSub = windowPathSub + '&type_propriete=' + prop.id;
    }
    else {
        windowPathSub = windowPathSub + '&type_propriete=blank';
    }
    console.log(windowPathSub)
    window.location.href = windowPathSub;


})




