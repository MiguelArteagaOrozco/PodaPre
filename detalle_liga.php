<?php
include_once('include/header.php');
$idLiga = $_GET['id'];
$jugadores = $db->query("select * from jugadores where id_liga='$idLiga';");
?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Listado de jugadores</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <a href="lista_liga.php"><button id="sample_editable_1_new" class="btn sbold green"> Volver a las ligas
                                                    </button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Nombre </th>
                                                <th> Apellido </th>
                                                <th> Nacimiento</th>
                                                <th> DNI </th>
                                                <th> Equipo </th>
                                                <th> Categoria </th>
                                                <th> Extra </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            while ($row = mysqli_fetch_array($jugadores)) {
                                                echo "<tr class='odd gradeX'>";
                                                echo "<td>".$row['id']."</td>";
                                                echo "<td>".$row['nombre']."</td>";
                                                echo "<td>".$row['apellido']."</td>";
                                                echo "<td>".$row['fecha_nacimiento']."</td>";
                                                echo "<td>".$row['dni']."</td>";

                                                $query = "SELECT * from equipo where id = ".$row['equipo'];
                                                $equipo = mysqli_fetch_assoc($db->query($query));

                                                echo "<td>".$equipo['nombre']."</td>";

                                                $query = "SELECT * from categoria where id = ".$row['categoria'];
                                                $categoria = mysqli_fetch_assoc($db->query($query));

                                                echo "<td>".$categoria['nombre']."</td>";
                                                echo "<td>".$row['extra']."</td>";
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include_once('include/footer.php');
?>