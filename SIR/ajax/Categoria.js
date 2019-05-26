
$(document).ready(function () {
    let edit;
    // console.log(SERVERURL);
    // console.log(edit);
    // listar();

    $('#categoria-form').submit(function (e) {
        // console.log(edit);
        const postData = {
            nombre: $('#categoria').val(),
            estado: $('#estado').val(),
            id: $('#id_categoria').val(),
            editando: edit
        }
        if ($('#estado').val() == null) {

            e.preventDefault();
        } else {
            if (edit == null || edit == false) {
                $.post(SERVERURL + 'Controller/categoriaController.php', postData, function (response) {
                    listar();
                    $('#categoria-form').trigger('reset');
                    // console.log(response);
                    if (response == 1) {
                        swal({
                            title: "LISTO",
                            text: "La Categoria ha sido registrada correctamente.",
                            type: "success",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },
                            function () {
                            });
                    } else if (response == 2) {
                        swal({
                            title: "Error Registro",
                            text: "La Categoria Ya Está Registrada En El Sistema.",
                            type: "warning",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },
                            function () {
                            });
                    } else {
                        // console.log(response);
                        swal({
                            title: "ERROR",
                            text: "No se púdo registrar la categoria. Intenta más tarde." + response,
                            type: "error",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },
                            function () {
                            });
                    }
                });
            } else if (edit == true) {
                $.post(SERVERURL + 'Controller/categoriaController.php', postData, function (response) {
                    listar();
                    $('#categoria-form').trigger('reset');
                    // console.log(response);
                    if (response == 1) {
                        swal({
                            title: "LISTO",
                            text: "La Categoria ha sido Actualizado correctamente.",
                            type: "success",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },
                            function () {
                            });
                    } else {
                        swal({
                            title: "ERROR",
                            text: "No se púdo actualizar. Intenta más tarde.",
                            type: "error",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },
                            function () {
                            });
                    }
                    edit = null;
                });
            }

            e.preventDefault();
        }
    });

    function listar() {
        if (edit == true) {
            $('#btnR').html("Registrar");

        }
        $.ajax({
            url: SERVERURL + 'Controller/categoriaController.php',
            type: 'GET',
            success: function (response) {
                // console.log(response);
                let categorias = JSON.parse(response);
                let template = '';
                let conta=0;
                categorias.forEach(categoria => {
                    if (conta>=10) {
                        
                    }else{
                    let estados = "Inactivo";;
                    if (categoria.estado == 1) { estados = "Activo"; }
                    template += `
                        <tr idCategoria="${categoria.idCategoria}" estado="${categoria.estado}">
                        <td style="display: none"></td>
                        <td>${categoria.nombre}</td>
                        <td>${estados}</td>
                        <td>
                        <button class="btn btn-primary categoria-edit text-center"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger categoria-delete text-center"><i class="fas fa-sync-alt fa-spin
                        " aria-hidden="true" ></i></button>
                        </td>
                        </tr>
                    `;}
                });
                $('#categorias').html(template);
            }
        });
    }

    $(document).on('click', '.categoria-delete', function () {
        let element = $(this)[0].parentElement.parentElement;
        let estado = $(element).attr('estado');
        let id = $(element).attr('idCategoria');
        const postData = {
            estado: estado,
            id: id,
        }
        swal({
            title: "LISTO",
            text: "El estado ha sido editado correctamente.",
            type: "success",
            confirmButtonText: "OK",
            closeOnConfirm: true
        },
            function () {
                $.post(SERVERURL + 'Controller/categoriaController.php', postData, function (response) {
                    // console.log(response);
                    listar();
                });
            });
    });

    $(document).on('click', '.categoria-edit', function () {
         $('#nombre').html("Editar Categoría");
        $('#btnR').html("Actualizar");
        let element = $(this)[0].parentElement.parentElement;
        let consul = $(element).attr('idCategoria');

        $.post(SERVERURL + 'Controller/categoriaController.php', { consul }, function (response) {
            let categor = JSON.parse(response);
            $('#categoria').val(categor[0].nombre);
            $('#estado').val(categor[0].estado);
            $('#id_categoria').val(categor[0].id_Categoria);
            edit = true;
        });

    });

    $(document).on('click', '.boton-limpiar', function () {
        $('#btnR').html("Registrar");
        // console.log(edit);
        edit = null;
    });
});

