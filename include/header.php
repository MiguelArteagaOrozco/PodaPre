<?php
header('Content-Type: text/html; charset=utf-8');
    session_start();
    if(empty($_SESSION['id'])){
        echo "<script>window.location='index.php';</script>";
    }

    include_once("clases/Database.php");
    $db = new Database();

    $id = $_SESSION['id'];
    $result = @mysqli_fetch_assoc($db->query("select * from usuarios where id = '$id'"));
    if($result['administrador'] == 1)
        $esAdmin = true;
    else 
        $esAdmin = false;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Poda | Panel administrativo </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="img/favicon.ico" /> 
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="home.php">
                        <img src="img/logo.png" alt="logo" width="160px" />
                    </a>
                </div>

                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                        <li class="nav-item ">
                            <a href="home.php" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title"><b>Inicio</b></span>
                            </a>
                        </li>

                        <?php
                        if($esAdmin){
                        ?>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-trophy"></i>
                                <span class="title"><b>Ligas</b></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="agregar_liga.php" class="nav-link ">
                                        <i class="fa fa-plus"></i>
                                        <span class="title"><b>Agregar liga</b></span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="lista_liga.php" class="nav-link ">
                                        <i class="fa fa-list"></i>
                                        <span class="title"><b>Listado de ligas</b></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="password-admin.php" class="nav-link nav-toggle">
                                <i class="fa fa-key"></i>
                                <span class="title"><b>Password</b></span>
                            </a>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class="nav-item  ">
                            <a href="nuevo_jugador.php" class="nav-link nav-toggle">
                                <i class="fa fa-plus"></i>
                                <span class="title"><b>Agregar nuevo jugador</b></span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="listado_jugadores.php" class="nav-link nav-toggle">
                                <i class="fa fa-list"></i>
                                <span class="title"><b>Listado de jugadores</b></span>
                            </a>
                        </li>
                        <?php    
                        }
                        ?>

                        <li class="nav-item  ">
                            <a href="logout.php" class="nav-link nav-toggle">
                                <i class="icon-logout"></i>
                                <span class="title"><b>Salir</b></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>