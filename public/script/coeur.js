let list=document.querySelectorAll(".coeur")

for(let i=0;i<list.length;i++) {
list[i].addEventListener("click",()=>{
    if(list[i].classList.contains("rouge")){list[i].classList.remove("rouge")}
    else {list[i].classList.add("rouge")}

})
}