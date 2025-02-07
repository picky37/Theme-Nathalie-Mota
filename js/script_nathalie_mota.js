console.log("connecté!!!!!!!!!!!");
 

// Function des filtres

document.addEventListener('DOMContentLoaded', function () {
    let postsPerPage = 8; // Nombre initial de posts chargés
    const loadMoreButton = document.getElementById('load-more'); // Bouton "Charger plus"
    const relatedPhotos = document.getElementById('related-photos'); // Conteneur des posts

    const taxonomyFilter = document.getElementById('taxonomy-filter');
    const categorieFilter = document.getElementById('categorie-filter');
    const dateFilter = document.getElementById('date-sort');

    // Fonction pour charger les posts (filtrage ou load more)
    function fetchPosts(reset = true) {
        const date = dateFilter ? dateFilter.value : 'desc';
        const format = taxonomyFilter ? taxonomyFilter.value : '';
        const categorie = categorieFilter ? categorieFilter.value : '';

        console.log(`Chargement des posts - Nombre de posts: ${postsPerPage}`);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', wp_data.ajax_url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                if (reset) {
                    relatedPhotos.innerHTML = xhr.responseText; // Remplace les posts si un filtre est appliqué
                } else {
                    relatedPhotos.insertAdjacentHTML('beforeend', xhr.responseText); // Ajoute les nouveaux posts
                }

                // Réappliquer animations et la lightbox après AJAX
                initializePhotoAnimations();

                if (typeof window.lightbox === 'function') {
                    console.log('Réinitialisation de la lightbox après AJAX');
                    window.lightbox('.lightbox');
                } else {
                    console.error('La lightbox n\'est pas disponible après AJAX.');
                }

                // Vérifier si des posts sont encore disponibles
                if (xhr.responseText.trim() === '<p>Aucun résultat trouvé.</p>') {
                    loadMoreButton.style.display = 'none'; // Masquer le bouton s'il n'y a plus de posts
                    console.log("Plus de posts à charger !");
                } else {
                    loadMoreButton.style.display = 'block'; // Afficher le bouton si encore des posts
                }

            } else {
                console.error("Erreur lors du chargement des articles.");
            }
        };

        const params = `action=filter_photos&posts_per_page=${encodeURIComponent(postsPerPage)}&date=${encodeURIComponent(date)}&format=${encodeURIComponent(format)}&categorie=${encodeURIComponent(categorie)}`;
        xhr.send(params);
    }

    // Appliquer les filtres
    if (taxonomyFilter && categorieFilter && dateFilter) {
        [taxonomyFilter, categorieFilter, dateFilter].forEach(function (filter) {
            filter.addEventListener('change', function () {
                postsPerPage = 8; // Réinitialiser à 8 posts si un filtre est appliqué
                fetchPosts(true); // Recharger les posts avec les nouveaux filtres
            });
        });
    }

    // Load More : Ajouter 8 posts supplémentaires à chaque clic
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function () {
            postsPerPage += 8; // Augmenter le nombre de posts affichés
            fetchPosts(false); // Charger plus de posts sans remplacer ceux existants
        });
    }
});










































// Sélectionne les éléments
const menuLink = document.getElementById("menu-item-26"); // Bouton pour ouvrir la modale
const popup = document.getElementById("modale_container"); // La modale elle-même

// Vérifie si les éléments existent
if (menuLink && popup) {
    // Ouvrir/Fermer la modale au clic sur menuLink
    menuLink.addEventListener("click", (event) => {
        event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
        popup.classList.toggle("show");
        console.log("bouton clicked");
    });

    // Fermer la modale si on clique en dehors d'elle
    document.addEventListener("click", (event) => {
        if (!popup.contains(event.target) && !menuLink.contains(event.target)) {
            popup.classList.remove("show");
        }
    });
}

const boutonContactSingle = document.getElementById("contact-button");

if (boutonContactSingle) {

    boutonContactSingle.addEventListener("click", (event) => {
        event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
        popup.classList.toggle("show");
        console.log("bouton clicked mameness");
    });

}

const boutonContactMobile = document.querySelector('#menu-menu-2 > li.menu-item.menu-item-type-custom.menu-item-object-custom.menu-item-26');

if (boutonContactMobile) {

    boutonContactMobile.addEventListener("click", (event) => {
        event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
        popup.classList.toggle("show");
        console.log("bouton clicked mameness");
    });

}











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

// Code pour préremplir le champ "référence" du formulaire de contact
document.addEventListener("DOMContentLoaded", function () {
    var referenceContainer = document.getElementById("reference-container");
    var reference = referenceContainer ? referenceContainer.getAttribute("data-reference") : null;

    // Sélectionner le champ de formulaire avec son ID
    var inputField = document.getElementById("wpforms-15-field_7");

    // Vérifier si l'élément existe et si la référence est valide
    if (inputField && reference) {
        inputField.value = reference;
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const menuLinkSingle = document.getElementById('menu-item-x');

    if (menuLinkSingle) {
        menuLinkSingle.addEventListener('click', () => {
            popup.classList.toggle('show');
        });
    } else {
        console.warn('Element #menu-item-x non trouvé dans le DOM');
    }
});














































































// // CHARGER PLUS (PHOTOS) + FILTRES (FUNCTIONS.PHP)
// let loading = false; // Indique si le chargement est en cours ou non
// const $loadMoreButton = jQuery('#load-more'); // Sélectionne le bouton "Charger plus"
// const $container = jQuery('.thumbnail-container-accueil'); // Sélectionne le conteneur de vignettes

// $loadMoreButton.on('click', function () {
//     get_more_posts(true) // Appelle la fonction pour obtenir plus de publications
// });

// function get_more_posts(load) {
//     let inputPage = $('input[name="page"]');
//     let page = parseInt(inputPage.val());
//     page = load ? page + 1 : 1; // Incrémente le numéro de page si "load" est vrai, sinon réinitialise à 1.
//     const category = $('select[name="category-filter"]').val();
//     const format = $('select[name="format-filter"]').val();
//     const dateSort = $('select[name="date-sort"]').val();

//     console.log(category, format, dateSort, page);

//     $.ajax({
//         type: 'GET',
//         url: wp_data.ajax_url, // Ceci est défini dans functions.php
//         data: {
//             action: 'load_more_posts',
//             page,
//             category,
//             format,
//             dateSort
//         },
//         success: function (response) {
//             if (response) {
//                 if (load) {
//                     $container.append(response); // Ajoute la réponse (nouvelles publications) au conteneur
//                 } else {
//                     $container.html(response); // Remplace le contenu du conteneur par la réponse (nouvelles publications)
//                 }
//                 $loadMoreButton.text('Charger plus'); // Remet le texte du bouton à "Charger plus"
//                 inputPage.val(page); // Met à jour le numéro de page
//                 loading = false; // Indique que le chargement est terminé
//             } else {
//                 if (load) {
//                     $loadMoreButton.text('Fin des publications'); // Change le texte du bouton en "Fin des publications"
//                 } else {
//                     let txt = '<div style="text-align:center;width:100%; color: #000;font-family: Space Mono, monospace;font-size: 16px;"><p>Aucun résultat ne correspond aux filtres de recherche.<br>';
//                     $container.html(txt); // Affiche un message si aucune réponse n'est trouvée
//                 }
//             }
//         },
//     });
//     if (!loading) {
//         loading = true;
//         $loadMoreButton.text('Chargement en cours...'); // Change le texte du bouton en "Chargement en cours..."
//     }
// }

// function recursive_change(selectId) {
//     $('#' + selectId).change(function () {
//         get_more_posts(false); // Appelle la fonction pour obtenir plus de publications sans "load"
//     });
// }

// if ($('#category-filter').length) {
//     recursive_change('category-filter'); // Applique la fonction de changement aux filtres de catégorie
// }

// if ($('#format-filter').length) {
//     recursive_change('format-filter'); // Applique la fonction de changement aux filtres de format
// }

// if ($('#date-sort').length) {
//     recursive_change('date-sort'); // Applique la fonction de changement aux filtres de tri par date
// }







