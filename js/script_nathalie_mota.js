// Stocke la modale de contact
const popup = document.getElementById('modale_container');

// Stocke le lien "CONTACT" du header
const menuLink = document.getElementById('menu-item-26');

// Stocke le lien "CONTACT" d'un single post
const menuLinkSingle = document.getElementById('menu-item-x');

// Logique d'apparition/disparition de la modale de contact depuis le header
menuLink.addEventListener('click', () => {
    popup.classList.toggle('show');
});

// Logique d'apparition/disparition de la modale de contact depuis un single post
menuLinkSingle.addEventListener('click', () => {
    popup.classList.toggle('show');
});

// Stocke le logo burger du header mobile
const burger1 = document.querySelector('.logo_burger1');

// Stocke le logo burger du menu déroulé à fond rouge
const burger2 = document.querySelector('.logo_burger2');

// Stocke le menu à fond rouge de la version mobile
const menuMobile = document.querySelector('.modal');

// Logique d'apparition du menu déroulant
burger1.addEventListener('click', () => {
    menuMobile.classList.toggle('changeMenuMobile');
});

// Logique de disparaition du menu déroulant
burger2.addEventListener('click', () => {
    menuMobile.classList.toggle('changeMenuMobile');
});

//Code pour préremplir le champ "référence" du formulaire de contact 
document.addEventListener("DOMContentLoaded", function () {
    var referenceContainer = document.getElementById("reference-container");
    if (referenceContainer) {
        var reference = referenceContainer.getAttribute("data-reference");
    }

    // Sélectionner le champ de formulaire avec son ID
    var inputField = document.getElementById("wpforms-15-field_7");

    // Vérifier si l'élément existe sur la page
    if (inputField) {
        // Préremplir le champ avec une valeur numérique par défaut
        inputField.value = reference;
    }
});