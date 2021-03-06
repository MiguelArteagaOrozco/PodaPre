<?php 

$hidden = "display-hide";
session_start();
if(!empty($_SESSION['id'])){
    echo "<script>window.location='home.php';</script>";
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    include_once("clases/Database.php");
    $db = new Database();
    $result = mysqli_fetch_assoc($db->query("select *  from usuarios where usuario = '$usuario' and password = '$password'"));

    if(!empty($result['id'])){
        $_SESSION['id'] = $result['id'];
        if($result['administrador'] == 1)
            echo "<script>window.location='home.php';</script>";
        else
            echo "<script>window.location='home.php';</script>";
    }else{
        $hidden = "";
    }
}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Poda | Panel administrativo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href=".img/favicon.ico" /> 
    </head>
    
    <body class=" login">
        <div class="content">
            <form class="login-form" action="index.php" method="post">
                <div class="form-title" style="text-align: center;">
                    <span><img src="img/logo.png" alt="logo"></span>
                    <br><br>
                    <span class="form-title">¡Bienvenido!</span>
                </div>
                <div class="alert alert-danger <?php echo $hidden; ?>">
                    <button class="close" data-close="alert"></button>
                    <span> Información incorrecta. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Usuario</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuario" name="usuario" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Entrar</button>
                </div>
            </form>
            
        </div>
        <div class="copyright hide"> 2016 © Poda. Panel administrativo. </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="assets/pages/scripts/login.min.js" type="text/javascript"></script>
    </body>

</html>