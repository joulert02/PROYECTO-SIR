<?php
session_start(['name' => 'SIR']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo SERVERURL; ?>public/img/Rodillos GBP.png" type="image/png">
    <title><?php echo COMPANY; ?></title>
    <script>
        const SERVERURL = "<?php echo SERVERURL; ?>";
    </script>
    <?php
    include 'view/templates/linkHomepage.php';
    require_once 'view/templates/script.php';
    ?>
</head>

<body class="margin"> 

    <?php
    $peticionAjax = false;
    require_once 'controller/vistasController.php';
    $vt = new vistasController();
    $vtr = $vt->obtener_vistas_controlador();
    if (
        $vtr == "login" || $vtr == "404" || $vtr == "./view/contents/recoverPassword-view.php" ||
        $vtr == "./view/contents/resetPassword-view.php" || $vtr == "./view/contents/Inicio-view.php" ||
        $vtr == "./view/contents/403-view.php" || $vtr == "./view/contents/E403-view.php" ||
        $vtr == "./view/contents/codePassword-view.php"
    ) :
        if ($vtr == "login") {
            require_once 'view/contents/login-view.php';
        } else if ($vtr == "./view/contents/recoverPassword-view.php" || $vtr == "./view/contents/resetPassword-view.php" || $vtr == "./view/contents/Inicio-view.php" || $vtr == "./view/contents/403-view.php" || $vtr == "./view/contents/E403-view.php" || $vtr == "./view/contents/codePassword-view.php") {
            require_once $vtr;
        } else {
            require_once 'view/contents/404-view.php';
        }
        echo '<script src="' . SERVERURL . 'public/js/particulas.js"></script>';
    else :
        // session_start(['name' => 'SIR']);
        require_once "./Controller/loginController.php";
        $lc = new loginController();
        if (!isset($_SESSION['usuario_sir']) || !isset($_SESSION['token_sir'])) {
            echo '<script>window.location.href="' . $lc->forzar_cierre_sesion_controlador() . '"</script>';
            die();
        }
        // $varsesion = $_SESSION['usuario_sir'];
        //     if ($varsesion== null || $varsesion=='') {
        //         echo '<script>window.location.href="location:E403"</script>';
        //         die();
        //     }   
        require_once 'view/templates/menu.php';
        include 'view/templates/link.php';
        ?>
        <section class="contentPage">
            <?php require_once $vtr; ?>
        </section>
        <script src="public/js/main.js"></script>
        <?php
        require_once "View/templates/logoutScript.php";
    endif; ?>
</body>

</html>