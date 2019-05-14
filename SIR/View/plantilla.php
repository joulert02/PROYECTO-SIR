<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo COMPANY; ?></title>
        
    <?php 
        session_start(['name' => 'SIR']);
        include 'view/templates/link.php';
        require_once 'view/templates/script.php';
    ?>
</head>

<body class="margin">
    <?php 
        $peticionAjax = false;
        require_once 'controller/vistasController.php'; 
        $vt = new vistasController();
        $vtr = $vt->obtener_vistas_controlador();
        
       if($vtr=="login" || $vtr=="404"):
            if ($vtr=="login") {
                require_once 'view/contents/login-view.php';
            } else {
                require_once 'view/contents/404-view.php';
            }
        
       else:
               
        if ($vtr=="./view/contents/recoverPassword-view.php" || $vtr=="./view/contents/resetPassword-view.php"|| $vtr=="./view/contents/Inicio-view.php"|| $vtr=="./view/contents/403-view.php"|| $vtr=="./view/contents/404-view.php"|| $vtr=="./view/contents/E403-view.php"|| $vtr=="./view/contents/codePassword-view.php") {
            echo '<script src="'.SERVERURL.'public/js/particulas.js"></script>';
            require_once $vtr; 
        } else {
            $varsesion = 1212;
            if ($varsesion== null || $varsesion=='') {
                header("location:E403");
                die();
            }   
    ?>
<?php require_once 'view/templates/menu.php';
 ?> 

    <section class="contentPage">
        <?php require_once $vtr; ?>
    </section>  
    <script src="public/js/main.js"></script>
    <?php };endif;?>   
</body>
</html>