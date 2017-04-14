<?php
include_once('include/header.php');
$ligas = mysqli_fetch_assoc($db->query("select count(*) as cant from liga"));
$jugadores = mysqli_fetch_assoc($db->query("select count(*) as cant from jugadores"));
$equipos = mysqli_fetch_assoc($db->query("select count(*) as cant from equipo"));

?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php 
                        if($esAdmin){
                    ?>
                    <h3 class="page-title"> 
                        Estadísticas
                    </h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-trophy"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="10"><?php echo $ligas['cant']; ?></span>
                                    </div>
                                    <div class="desc"> Ligas </div>
                                </div>
                                <a class="more" href="new_user.php"> 
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="10"><?php echo $jugadores['cant']; ?></span>
                                    </div>
                                    <div class="desc"> Jugadores </div>
                                </div>
                                <a class="more" href="new_user.php"> 
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-flag"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="10"><?php echo $equipos['cant']; ?></span>
                                    </div>
                                    <div class="desc"> Equipos </div>
                                </div>
                                <a class="more" href="new_user.php"> 
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                            $idUser = $_SESSION['id'];
                            $result = mysqli_fetch_assoc($db->query("SELECT * from usuarios where id=  $idUser"));
                            $idLiga = $result['id_liga'];
                            $jugadores = mysqli_fetch_assoc($db->query("select count(*) as cant from jugadores where id_liga='$idLiga'"));
                    ?>
                    <h3 class="page-title"> 
                        Bienvenido!
                    </h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="10"><?php echo $jugadores['cant']; ?></span>
                                    </div>
                                    <div class="desc"> Jugadores </div>
                                </div>
                                <a class="more" href="nuevo_jugador.php"> 
                                Agregar</a>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
<?php
include_once('include/footer.php');
?>