let li=document.querySelectorAll(".filtre div");
var lastelemnt=null;
async function selectionner(newelement){ if (lastelemnt){

    lastelemnt.querySelector("div").style.color=("rgba(125, 125, 125, 0.75)");
    lastelemnt.querySelector(("i")).style.color=("rgba(125, 125, 125, 0.75)");

}

    newelement.querySelector("div").style.color=("black");
    newelement.querySelector(("i")).style.color=("black");
    lastelemnt=newelement;


}
for (let i=0;i<li.length;i++)
    li[i].addEventListener("click", () => {
        selectionner(li[i]);
    })

