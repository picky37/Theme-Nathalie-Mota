console.log('connecté !');

const popup = document.getElementById('modale_container');
console.log(popup);
const closeButton = document.getElementById('closeButton');
const menuLink = document.getElementById('menu-item-26');
const menuLinkSingle = document.getElementById('menu-item-x');


menuLink.addEventListener('click', () => {
    popup.classList.toggle('show');
    console.log('close');
});

menuLinkSingle.addEventListener('click', () => {
    popup.classList.toggle('show');
    console.log('close');
});
 
const burger1 = document.querySelector('.logo_burger1');
const burger2 = document.querySelector('.logo_burger2');
const menuMobile = document.querySelector('.modal');

burger1.addEventListener('click', () => {
    console.log('burger 1 cliqué');
    menuMobile.classList.toggle('changeMenuMobile');
});

burger2.addEventListener('click', () => {
    console.log('burger 2 cliqué');
    menuMobile.classList.toggle('changeMenuMobile');
});

//Code pour préremplir le champ "référence" du formulaire de contact 






document.addEventListener("DOMContentLoaded", function() {

    var referenceContainer = document.getElementById("reference-container");
    if (referenceContainer) {
        var reference = referenceContainer.getAttribute("data-reference");
        console.log("Référence récupérée :", reference);
    }

    // Sélectionner le champ de formulaire avec son ID
    var inputField = document.getElementById("wpforms-15-field_7");
    
    // Vérifier si l'élément existe sur la page
    if (inputField) {
        // Préremplir le champ avec une valeur numérique par défaut
        inputField.value = reference;
        console.log(inputField.value);
    }
});