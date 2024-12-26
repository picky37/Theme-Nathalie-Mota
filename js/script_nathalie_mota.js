console.log("connecté");

// Stocke la modale de contact
const popup = document.getElementById('modale_container');

// Stocke le lien "CONTACT" du header
const menuLink = document.getElementById('menu-item-26');

// Logique d'apparition/disparition de la modale de contact depuis le header
menuLink.addEventListener('click', () => {
    popup.classList.toggle('show');
});

// Stocke le logo burger du header mobile
const burger1 = document.querySelector('.logo_burger1');
console.log(burger1);

// Stocke le logo burger du menu déroulé à fond rouge
const burger2 = document.querySelector('.logo_burger2');

// Stocke le menu à fond rouge de la version mobile
const menuMobile = document.querySelector('.modal');

// Logique d'apparition du menu déroulant
burger1.addEventListener('click', () => {
    console.log(burger1);
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

// Stocke le lien "CONTACT" d'un single post
const menuLinkSingle = document.getElementById('menu-item-x');
console.log(menuLinkSingle);

// Logique d'apparition/disparition de la modale de contact depuis un single post
menuLinkSingle.addEventListener('click', () => {
    popup.classList.toggle('show');
});





















































































// CHARGER PLUS (PHOTOS) + FILTRES (FUNCTIONS.PHP)
let loading = false; // Indique si le chargement est en cours ou non
const $loadMoreButton = $('#load-more'); // Sélectionne le bouton "Charger plus"
const $container = $('.thumbnail-container-accueil'); // Sélectionne le conteneur de vignettes

$loadMoreButton.on('click', function () {
    get_more_posts(true) // Appelle la fonction pour obtenir plus de publications
});

function get_more_posts(load) {
    let inputPage = $('input[name="page"]');
    let page = parseInt(inputPage.val());
    page = load ? page + 1 : 1; // Incrémente le numéro de page si "load" est vrai, sinon réinitialise à 1.
    const category = $('select[name="category-filter"]').val();
    const format = $('select[name="format-filter"]').val();
    const dateSort = $('select[name="date-sort"]').val();

    console.log(category, format, dateSort, page);

    $.ajax({
        type: 'GET',
        url: wp_data.ajax_url, // Ceci est défini dans functions.php
        data: {
            action: 'load_more_posts',
            page,
            category,
            format,
            dateSort
        },
        success: function (response) {
            if (response) {
                if (load) {
                    $container.append(response); // Ajoute la réponse (nouvelles publications) au conteneur
                } else {
                    $container.html(response); // Remplace le contenu du conteneur par la réponse (nouvelles publications)
                }
                $loadMoreButton.text('Charger plus'); // Remet le texte du bouton à "Charger plus"
                inputPage.val(page); // Met à jour le numéro de page
                loading = false; // Indique que le chargement est terminé
            } else {
                if (load) {
                    $loadMoreButton.text('Fin des publications'); // Change le texte du bouton en "Fin des publications"
                } else {
                    let txt = '<div style="text-align:center;width:100%; color: #000;font-family: Space Mono, monospace;font-size: 16px;"><p>Aucun résultat ne correspond aux filtres de recherche.<br>';
                    $container.html(txt); // Affiche un message si aucune réponse n'est trouvée
                }
            }
        },
    });
    if (!loading) {
        loading = true;
        $loadMoreButton.text('Chargement en cours...'); // Change le texte du bouton en "Chargement en cours..."
    }
}

function recursive_change(selectId) {
    $('#' + selectId).change(function () {
        get_more_posts(false); // Appelle la fonction pour obtenir plus de publications sans "load"
    });
}

if ($('#category-filter').length) {
    recursive_change('category-filter'); // Applique la fonction de changement aux filtres de catégorie
}

if ($('#format-filter').length) {
    recursive_change('format-filter'); // Applique la fonction de changement aux filtres de format
}

if ($('#date-sort').length) {
    recursive_change('date-sort'); // Applique la fonction de changement aux filtres de tri par date
}
