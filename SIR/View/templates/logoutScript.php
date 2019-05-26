<script>
    $(document).ready(function() {
        $('.btn-exit-system').on('click', function(e) {
            e.preventDefault();
            var Token = $(this).attr('href');
            swal({
                    title: "¿Estás seguro?",
                    text: "La sesión actual se cerrara y deberas iniciar sesión nuevamente",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-info",
                    confirmButtonText: "Si, cerrar!",
                    cancelButtonClass: "btn-danger",
                    cancelButtonText: "No, cancelar!",
                },
                function() {
                    window.location.href = "login/"
                });
        });
    });
</script>