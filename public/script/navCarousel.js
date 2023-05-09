let windowPathf = window.location.origin + '/homepage';
if(window.location.pathname==='/homepage')
{windowPathf+="/filtreCarousel="
}
else if (window.location.pathname.includes('/homepage'+"/filtreCarousel=")){
    windowPathf+="/filtreCarousel="
}
else if(window.location.pathname.includes('/homepage'+"/location=") && window.location.pathname.includes("/filtreCarousel") ){
    pos=window.location.pathname.indexOf("/filtreCarousel");
    windowPathf=window.location.origin +window.location.pathname.slice(0,pos)+"/filtreCarousel=";
}
else {
    windowPathf=window.location.origin +window.location.pathname+"/filtreCarousel="
}



let li=document.querySelectorAll(".filtre div");


var lastelemnt=null;
async function selectionner(newelement){ if (lastelemnt){

    lastelemnt.querySelector("div").style.color=("rgba(125, 125, 125, 0.75)");
    lastelemnt.querySelector(("i")).style.color=("rgba(125, 125, 125, 0.75)");

}

    newelement.querySelector("div").style.color=("black");
windowPathf+=newelement.querySelector("div").textContent
    newelement.querySelector(("i")).style.color=("black");
    lastelemnt=newelement;
    window.location.href= windowPathf;



}
tab=window.location.pathname.split("%20");
str=tab.join(" ");
for (let i=0;i<li.length;i++){
    if(li[i].querySelector("div"))
        if (str.includes(li[i].querySelector("div").textContent))
        {li[i].querySelector("div").style.color=("black");
        li[i].querySelector(("i")).style.color=("black");}

    li[i].addEventListener("click", () => {
        selectionner(li[i]);

    })
}



