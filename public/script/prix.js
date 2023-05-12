 dateDeb=document.querySelector('#reservation_DateDebut')
dateF=document.querySelector('#reservation_DateFin')
prix=document.querySelector('#prix')
 totPrix=document.querySelector('#totPrix')
 frais=document.querySelector('#frais')
 tot=document.querySelector('#tot')
 nbJour=document.querySelector('#nbJour')
 btn=document.querySelector('#reservation_Reserver')



 dateF.addEventListener('change',function ()
     {
      changeNbJour(dateF.value,dateDeb.value)
     }

 )
 dateDeb.addEventListener('change',function ()
     {
      changeNbJour(dateF.value,dateDeb.value)
     }

 )




 function changeNbJour(dateF,dateDeb)
 {


  if (dateF> dateDeb)
  {
   btn.disabled=false;
   var date1 = new Date(dateF);
   var date2 = new Date(dateDeb);

// Calcul de la différence en millisecondes
   var difference = date1 - date2;

// Conversion de la différence en jours
   var differenceEnJours = Math.floor(difference / (1000 * 60 * 60 * 24));


nbJour.textContent= ' x ' + differenceEnJours;
totPrix.textContent=parseInt(differenceEnJours * parseInt(prix.textContent))+'$'
frais.textContent= parseInt(differenceEnJours * parseInt(prix.textContent) * 0.1)+'$'
tot.textContent=parseInt((differenceEnJours * parseInt(prix.textContent))*1.1)+'$'
  }
  else{
   btn.disabled=true;

  }
 }
