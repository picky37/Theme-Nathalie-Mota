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
            postsPerPage += 1; // Augmenter le nombre de posts affichés
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