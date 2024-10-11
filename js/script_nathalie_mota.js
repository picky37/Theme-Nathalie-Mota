console.log('connecté !');


const popup = document.getElementById('modale_container');
console.log(popup);
const closeButton = document.getElementById('closeButton');
const menuLink = document.getElementById('menu-item-26');


menuLink.addEventListener('click', () => {
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

function chargerPage() {
    fetch('page.html') // Remplacez par l'URL de votre page à charger
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.text();
        })
        .then(html => {
            // Créer un élément temporaire pour obtenir le contenu du body
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            // Extraire le contenu du body
            const bodyContent = tempDiv.querySelector('body').innerHTML;

            // Insérer le contenu dans la page actuelle
            document.getElementById('contenu').innerHTML = bodyContent;
        })
        .catch(error => {
            console.error('Erreur lors du chargement de la page:', error);
        });
}