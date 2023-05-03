/*var bodyItems=document.querySelectorAll(':not(#myContent2)');*/
var toggleDown = document.getElementById('myToggle1');
var toggleQuit = document.getElementById('myToggle2');
var content1 = document.getElementById('myContent1');
var content2 = document.getElementById('myContent2');

const content = document.querySelectorAll('.content');

content2.style.display = 'none';

toggleDown.addEventListener('click', function () {
    content2.style.display = '';
    content1.style.display = 'none';
    /* for(let i = 0; i < bodyItems.length; i++) {

         bodyItems[i].style.opacity = 0.7;
     }*/

});

toggleQuit.addEventListener('click', function () {
    content1.style.display = '';
    content2.style.display = 'none';
    /*    for(let i = 0; i < bodyItems.length; i++) {

            bodyItems[i].style.opacity = 1;
        }*/
});

document.addEventListener("click", (event) => {
    let isClickInside = content1.contains(event.target) || content2.contains(event.target);
    if (!isClickInside) {
        content1.style.display = '';
        content2.style.display = 'none';
    }
});
