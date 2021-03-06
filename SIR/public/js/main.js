$('.FormularioAjax').submit(function(e){
    
    e.preventDefault();
    
    var form=$(this);

    var tipo=form.attr('data-form');
    var action=form.attr('action');
    var metodo=form.attr('method');
    var respuesta=form.children('.RespuestaAjax');

    var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
    var formdata = new FormData(this);


    var textoAlerta;
    if(tipo==="save"){
        textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
    }else if(tipo==="delete"){
        textoAlerta="Los datos serán eliminados completamente del sistema";
    }else if(tipo==="update"){
        textoAlerta="Los datos del sistema serán actualizados";
    }else{
        textoAlerta="Quieres realizar la operación solicitada";
    }

    var instance =$('#validate_form').parsley();
    if (!instance.isValid()) {
        respuesta.html('<div class="alert alert-danger" role="alert">Debes llenar los campos requeridos</div>');
    }else{
        
    swal({
        title: "¿Estás seguro?",   
        text: textoAlerta,
        type: "info",   
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true
      },
      function(){
        $.ajax({
            type: metodo,
            url: action,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    if(percentComplete<100){
                        respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      }else{
                          respuesta.html('<p class="text-center"></p>');
                      }
                  }
                }, false);
                return xhr;
            },
            success: function (data) {
                $(".RespuestaAjax").html(data);
                respuesta.html(data);
                console.log(data);
                // window.location.href="listPerson";
            },
            error: function() {
                $(".RespuestaAjax").html(data);
                respuesta.html(data);
                respuesta.html(msjError);
            }
        });
        return false;
      });
    }

});