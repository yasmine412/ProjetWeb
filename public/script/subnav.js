const numberBoxes = document.querySelectorAll('.number-boxes');
const type = document.querySelectorAll('.type');
const price = document.querySelector('#price');
const affiche = document.querySelector('#prix-affiche');

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
    box.classList.toggle('selected-type');

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
    affiche.innerHTML ="<b>"+ price.value+ " €</b>";
});




