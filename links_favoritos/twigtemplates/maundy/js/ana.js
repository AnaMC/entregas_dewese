$(function() {
    
    $('.borrar').on('click', function(e) {

        if (!confirm("¿Estás seguro de borrar a este usuario?")) {
                e.preventDefault();
        }
    });
    
});
