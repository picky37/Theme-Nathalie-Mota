console.log("script photo connecté");

document.addEventListener('DOMContentLoaded', function () {
    // Prépare la requête Ajax
    fetch(ajax_object.ajax_url, {
        method: 'POST',
        body: new URLSearchParams({
            action: 'Photos' // Nom de l'action définie dans functions.php
        }),
    })
    .then(response => response.json()) // Convertit la réponse en JSON
    .then(data => {
        // Affiche les données retournées dans la console
        console.log('Réponse Ajax :', data);
    })
    .catch(error => {
        console.error('Erreur Ajax :', error);
    });
});
