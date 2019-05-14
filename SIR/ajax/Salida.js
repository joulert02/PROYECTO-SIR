$(document).ready(function(){
    // let edit;
    // console.log(edit);
    listar2();
    listar();

    $(document).on('click', '#insertarP', function(e){
        e.preventDefault();
            let element = $(this)[0].parentElement.parentElement;
            const postData = {
                Producto_id_producto : $(element).attr('Producto_id_producto'),
                cantidad : $('#cantidad_'+ $(element).attr('Producto_id_producto')).val(),
            }
            // console.log(postData);
            $.post('http://localhost/SIR/Controller/exitAjax.php', postData, function(response){
                    // listar();
                    // console.log(response);
                    if (response==1) {
                       alertify.success("<i class=\"fa fa-check-circle\"></i> <b>Producto</b> Agregado correctamente"); 
                        //alert("Agregaste Este producto");
                        //times-circle
                        //header("Location:addEntry");
                        // swal({title: "LISTO",    
                        //       text: "La Categoria ha sido registrada correctamente.", 
                        //       type:"success", 
                        //       confirmButtonText: "OK", 
                        //       closeOnConfirm: true 
                        //     }, 
                        //     function(){
                                listar(); 
                            // });  
                    } else {
                        // console.log(response);
                    swal({title: "ERROR",    
                        text: "No se púdo registrar la categoria. Intenta más tarde."+response, 
                        type:"error", 
                        confirmButtonText: "OK", 
                        closeOnConfirm: true 
                      }, 
                      function(){ 
                      });  
                    }
                });

    }); $(document).on('click', '#eliminar', function(e){
        e.preventDefault();
        let element = $(this)[0].parentElement.parentElement;
          const postData = {
            Producto_id_producto : $(element).attr('Producto_id_producto'),
        }
        // console.log(postData);
            $.post('http://localhost/SIR/Controller/exitAjax.php', postData, function(response){
                    listar();
                    $('#categoria-form').trigger('reset');
                    // console.log(response);
                    if (response) {
                       alertify.error("<i class=\"fa fa-check-circle\"></i> <b>Producto</b> Anulado Correctamente"); 
                       listar(); 
                           
                    } else {
                        // console.log(response);
                    swal({title: "ERROR",    
                        text: "No se púdo registrar la categoria. Intenta más tarde."+response, 
                        type:"error", 
                        confirmButtonText: "OK", 
                        closeOnConfirm: true 
                      }, 
                      function(){ 
                      });  
                    }
                });
    });

    function listar2(){
        $.ajax({
            url : 'http://localhost/SIR/Controller/exitAjax.php',
            type : 'GET',
            success : function(response){
                // console.log(response);
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(productos => {
                    template += `
                        <tr Producto_id_producto="${productos.Producto_id_producto}" valor="${productos.cantidad}">
                        <td style="display: none"></td>
                        <td>${productos.referencia}</td>
                        <td>${productos.nombre_producto}</td>
                        <td>
                        <input type="number" style="width:60%;" class="form-control" id="cantidad_${productos.Producto_id_producto}" value="1">
                        </td>
                        <td>
                        <button class="btn btn-primary text-center" id="insertarP"><i class="glyphicon glyphicon-plus"></i></button>
                        </td>
                        </tr>
                    `;
                });
                $('#product').html(template);
            } 
        });
};

    function listar(){
        let listar="listar";
        let total=0;
            $.post('http://localhost/SIR/Controller/exitAjax.php', listar, function(response){
                // $('#categoria-form').trigger('reset');
                // console.log(response);
                if (response) {
                  let productos = JSON.parse(response);
                  let template = '';
                  productos.forEach(productos => {
                      total+=parseInt(productos);
                      template += `
                          <tr Producto_id_producto="${productos.idTmp}">
                          <td>${productos.referencia}</td>
                          <td>${productos.nombre_producto}</td>
                          <td>${productos.cantidad}</td>
                          <td>
                          <button title="Eliminar" class="btn btn-danger delete text-center" id="eliminar"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>
                          </td>
                          </tr>
                      `;
                  });
                  $('#dir').val(total);
                  $('#insumo').html(template);
                } else {
                    console.log(response);
                swal({title: "ERROR",    
                    text: "No se púdo registrar la categoria. Intenta más tarde."+response, 
                    type:"error", 
                    confirmButtonText: "OK", 
                    closeOnConfirm: true 
                  }, 
                  function(){ 
                  });  
                }
            });
    }

    $(document).on('click', '.categoria-delete', function(){
        let element = $(this)[0].parentElement.parentElement;
        let estado = $(element).attr('estado');
        let id = $(element).attr('idCategoria');
        const postData = {
            estado : estado,
            id : id,
        }
        swal({title: "LISTO",    
          text: "El estado ha sido editado correctamente.", 
          type:"success", 
          confirmButtonText: "OK", 
          closeOnConfirm: true 
        }, 
        function(){ 
            $.post('http://localhost/SIR/Controller/exitAjax.php', postData, function(response) {
                // console.log(response);
                listar();
            });
        });  
    });

    $(document).on('click', '.categoria-edit', function(){
        $('#btnR').html("Actualizar");
        let element = $(this)[0].parentElement.parentElement;
        let consul = $(element).attr('idCategoria');

        $.post('http://localhost/SIR/Controller/exitAjax.php', {consul}, function(response) {
            let categor = JSON.parse(response);
            $('#categoria').val(categor[0].nombre_producto);
            $('#referencia').val(categor[0].referencia);
            $('#estado').val(categor[0].estado);
            $('#id_categoria').val(categor[0].id_Categoria);
            edit = true;
        });
        
    });

    $(document).on('click', '.boton-limpiar', function(){
        $('#btnR').html("Registrar");
        console.log(edit);
        edit = null;
    });
});