let totalValue = 0;
const incrementBtns = document.querySelectorAll(".increment-btn");



function increment(inputField,inputClass) {

    const input = document.querySelector(inputField);
    const decrementBtn = document.querySelector(".decrement-btn"+inputClass);
    const incrementBtn = document.querySelector(".increment-btn"+inputClass);

    let inputValue = parseInt(input.textContent);
    if (totalValue<16) {
        inputValue++;
        totalValue++;
        input.textContent = inputValue;
        decrementBtn.disabled = false;
        
    }
    
    if (totalValue==16) {
        incrementBtn.disabled = true;
    }

}

function decrement(inputField,inputClass) {

    const input = document.querySelector(inputField);
    const decrementBtn = document.querySelector(".decrement-btn"+inputClass);
    const incrementBtn = document.querySelector(".increment-btn"+inputClass);
    let inputValue = parseInt(input.textContent);

    if (inputValue > 0) {
        inputValue--;
        totalValue--;
        input.textContent = inputValue;
        incrementBtn.disabled=false;
        if ((inputValue==0)||(totalValue==0)) {
            decrementBtn.disabled = true;
        }
        incrementBtns.forEach(element => {
            element.disabled = false;
        })

    }
    else {
        decrementBtn.disabled = true;
    }
    
}

