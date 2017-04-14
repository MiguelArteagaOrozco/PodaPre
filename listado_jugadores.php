<?php
    include_once('include/header.php');
    $idUser = $_SESSION['id'];
    $result = mysqli_fetch_assoc($db->query("SELECT * from usuarios where id=  $idUser"));
    $idLiga = $result['id_liga'];
    $ligas = $db->query("select * from jugadores where id_liga = $idLiga;"); /* falta el    where id_liga='$idLiga'  o algo así */
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
                                                    <a href="nuevo_jugador.php"><button id="sample_editable_1_new" class="btn sbold green"> Agregar Jugador
                                                        <i class="fa fa-plus"></i>
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
                                                <th> Fecha Nacimiento </th>
                                                <th> DNI </th>
                                                <th> Equipo </th>
                                                <th> Categoria </th>
                                                <th> Extra </th>
                                                <th> Imagen </th>
                                                <th> Eliminar </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            while ($row = mysqli_fetch_array($ligas)) {
                                                echo "<tr class='odd gradeX'>";
                                                echo "<td>".$row['id']."</td>";
                                                echo "<td>".$row['nombre']."</td>";
                                                echo "<td>".$row['apellido']."</td>";
                                                echo "<td>".$row['fecha_nacimiento']."</td>";
                                                echo "<td>".$row['dni']."</td>";
                                                $idEquipo = $row['equipo'];
                                                $equipos = $db->query("select * from equipo where id = '$idEquipo'");
                                                $equipo = mysqli_fetch_array($equipos);

                                                $idCategoria = $row['categoria'];
                                                $categorias = $db->query("select * from categoria where id = '$idCategoria'");
                                                $categoria = mysqli_fetch_array($categorias);
                                                echo "<td>".$equipo['nombre']."</td>";
                                                echo "<td>".$categoria['nombre']."</td>";
                                                echo "<td>".$row['extra']."</td>";
                                                echo "<td><img src='liga/".$idLiga."/".$row['id'].".png' width=80 height=80></td>";
                                                echo "<td><a href='#' onclick='eliminar_jugador(".$row['id'].")' ><span class='label label-sm label-warning'> Eliminar </span></a></td>";
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

        <script type="text/javascript">
            function eliminar_jugador(v)
            {
                if (confirm("¿Esta seguro que desea eliminar al jugador " + v + "?"))
                {
                    window.location= 'eliminar_jugador.php?id=' + v;
                }
            }
        </script>
<?php
    include_once('include/footer.php');
?>