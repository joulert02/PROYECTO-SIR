<?php
session_start(['name' => 'SIR']);
echo '<script type="text/javascript"> 
swal({title: "LISTO",    
      text: "Sessión Cerrada Con Exito.", 
      type:"success", 
      confirmButtonText: "OK", 
      closeOnConfirm: false 
    }, 
    function(){ 
      window.location.href="localhosst:8080/PROYECTO-SIR/SIR/login"; 
    });  
</script>';
session_destroy();
