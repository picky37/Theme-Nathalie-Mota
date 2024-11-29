console.log("Script photo connecté");

jQuery(document).ready(function($) {
    $('#load-more').on('click', function() {
        var button = $(this);
        var page = button.data('page') || 1; // Valeur par défaut de page si elle n'est pas définie
        var newPage = page + 1;

        $.ajax({
            url: ajax_params.ajax_url, // Utilisation de la variable localisée
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page,
            },
            beforeSend: function() {
                button.text('Chargement...'); // Indiquer que le chargement est en cours
            },
            success: function(response) {
                if ($.trim(response)) {
                    $('#photo-list').append(response);
                    button.data('page', newPage);
                    button.text('Charger plus');
                } else {
                    button.text('Plus de photos disponibles').prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des photos : ", error);
            },
            complete: function() {
                button.prop('disabled', false); // Réactiver le bouton après la requête
            }
        });
    });
});
