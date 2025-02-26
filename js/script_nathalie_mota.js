console.log("connecté!!!!!!!!!!!");


// Function des filtres

document.addEventListener('DOMContentLoaded', function () {
    let postsPerPage = 8; // Nombre de posts chargés par clic
    let offset = document.querySelectorAll('#related-photos a').length; // Nombre initial de posts affichés
    const loadMoreButton = document.getElementById('load-more');
    const relatedPhotos = document.getElementById('related-photos');

    const taxonomyFilter = document.getElementById('taxonomy-filter');
    const categorieFilter = document.getElementById('categorie-filter');
    const dateFilter = document.getElementById('date-sort');

    function fetchPosts(reset = true) {

        const date = dateFilter ? dateFilter.value : 'desc';
        const format = taxonomyFilter ? taxonomyFilter.value : '';
        const categorie = categorieFilter ? categorieFilter.value : '';

        if (reset) {
            offset = 0; // Réinitialiser l'offset quand on applique un filtre
        }

        console.log(`Chargement des posts - Offset: ${offset}, Nombre de posts: ${postsPerPage}`);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', wp_data.ajax_url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                if (reset) {
                    relatedPhotos.innerHTML = xhr.responseText; // Remplace les posts si un filtre est appliqué
                    offset = document.querySelectorAll('#related-photos a').length; // Réajuster l'offset
            
                } else {





                    relatedPhotos.insertAdjacentHTML('beforeend', xhr.responseText); // Ajoute les nouveaux posts
                    offset += postsPerPage; // Incrémenter l'offset après ajout
                }

                initializePhotoAnimations();

                if (typeof window.lightbox === 'function') {
                    console.log('Réinitialisation de la lightbox après AJAX');

                    window.lightbox('.lightbox');
                } else {
                    console.error('La lightbox n\'est pas disponible après AJAX.');
                }

                if (xhr.responseText.trim() === '<p>Aucun résultat trouvé.</p>') {
                    loadMoreButton.style.display = 'none';
                    console.log("Plus de posts à charger !");
                } else {
                    loadMoreButton.style.display = 'block';
                }
            } else {
                console.error("Erreur lors du chargement des articles.");
            }
        };

        const params = `action=filter_photos&posts_per_page=${encodeURIComponent(postsPerPage)}&offset=${encodeURIComponent(offset)}&date=${encodeURIComponent(date)}&format=${encodeURIComponent(format)}&categorie=${encodeURIComponent(categorie)}`;
        xhr.send(params);
    }

    if (taxonomyFilter && categorieFilter && dateFilter) {
        [taxonomyFilter, categorieFilter, dateFilter].forEach(function (filter) {
            filter.addEventListener('change', function () {
                postsPerPage = 8;
                fetchPosts(true);
            });
        });
    }

    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function () {
            fetchPosts(false);

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



function updateCaptions() {

         
    // Récupérer tous les éléments .post-data
    var postDataElements = document.querySelectorAll('.post-data');

    // Récupérer tous les éléments figure
    var figures = document.querySelectorAll("figure");

    // Vérifier si le nombre de post-data correspond au nombre de figures
    if (postDataElements.length !== figures.length) {
      console.warn(`Mismatch detected: ${postDataElements.length} .post-data elements but ${figures.length} figures found.`);
    }

    // Parcourir chaque élément .post-data pour récupérer les données
    postDataElements.forEach((postData, index) => {
      // Vérifier si un figure correspondant existe
      var figure = figures[index];
      if (figure) {
        // Supprimer l'ancien figcaption s'il existe
        var existingFigcaption = figure.querySelector("figcaption");
        if (existingFigcaption) {
          figure.removeChild(existingFigcaption);
        }

        // Récupérer les données
        var reference = postData.getAttribute('data-reference') || "Référence non disponible";
        var category = postData.getAttribute('data-category') || "Catégorie non disponible";

        // Créer un nouveau figcaption
        var figcaption = document.createElement("figcaption");

        // Ajouter la référence
        var referenceDiv = document.createElement("div");
        referenceDiv.className = "reference";
        referenceDiv.textContent = reference;
        figcaption.appendChild(referenceDiv);

        // Ajouter la catégorie
        var categoryDiv = document.createElement("div");
        categoryDiv.className = "category";
        categoryDiv.textContent = category;
        figcaption.appendChild(categoryDiv);

        // Ajouter le figcaption au figure correspondant
        figure.appendChild(figcaption);

        // Afficher dans la console les données pour vérification
        console.log("choupette...");
      } else {
        console.warn(`No figure found for post-data at index ${index}`);
      }
    });

    // Vérifier et traiter manuellement la dernière image si nécessaire
    if (figures.length > postDataElements.length) {
      var lastFigure = figures[figures.length - 1];
      var lastPostData = postDataElements[postDataElements.length - 1];
      if (lastFigure && lastPostData) {
        console.warn("Processing last figure manually.");

        // Supprimer l'ancien figcaption s'il existe
        var existingFigcaption = lastFigure.querySelector("figcaption");
        if (existingFigcaption) {
          lastFigure.removeChild(existingFigcaption);
        }

        

    

      

        
      } else {
        console.error("Failed to process last figure or last post-data.");
      }
    }
  }