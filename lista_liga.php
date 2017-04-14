<?php
    include_once('include/header.php');
    $ligas = $db->query("select * from liga");
?>
<style type="text/css"></style>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">

                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Listado de ligas </span>
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <a href="agregar_liga.php">
                                                        <button id="sample_editable_1_new" class="btn sbold green"> Agregar nueva liga <i class="fa fa-plus"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="clearfix"> </div>
                                    </div>

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> ID</th>
                                                <th> Nombre de la liga </th>
                                                <th> Usuario </th>
                                                <th> Cantidad de jugadores cargados </th>
                                                <th> Borrar </th>
                                                <th> Descargar </th>
                                                <th> Ver mas</th>
                                                <th> Eliminar </th>
                                                <th> Password </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        while ($row = mysqli_fetch_array($ligas)) {
                                            $query = "SELECT count(*) as cantidad from jugadores where id_liga = ".$row['id'];
                                            $ligas2 = mysqli_fetch_assoc($db->query($query));

                                            $query = "SELECT * from usuarios where id_liga = ".$row['id'];
                                            $usuario = mysqli_fetch_assoc($db->query($query));
                                            echo "<tr class='odd gradeX'>";
                                            echo "<td>".$row['id']."</td>";
                                            echo "<td>".$row['nombre']."</td>";
                                            echo "<td>".$usuario['usuario']."</td>";
                                            echo "<td>".$ligas2['cantidad']."</td>";
                                            echo "<td><a href='delete.php?id=".$row['id']."' ><span class='label label-sm label-info'> Vaciar </span></a></td>";
                                            if($ligas2['cantidad'] > 0)
                                                echo "<td><a href='descargar.php?id=".$row['id']."'><span class='label label-sm label-danger'> Descargar </span></a></td>";
                                            else
                                                echo "<td></td>";
                                            echo "<td><a href='detalle_liga.php?id=".$row['id']."' ><span class='label label-sm label-success'> Ver mas </span></a></td>";
                                            
                                            echo "<td><a onclick='eliminar_liga(".$row['id'].")' href='#' ><span class='label label-sm label-warning'> Eliminar </span></a></td>";
                                            echo "<td><a href='password-liga.php?id=".$row['id']."' ><span class='label label-sm label-success'> Password </span></a></td>";
                                            
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
        function eliminar_liga(v)
        {
            if (confirm("¿Esta seguro que desea eliminar la liga " + v + "?"))
            {
                window.location= 'eliminar_liga.php?id=' + v;
            }
        }
        </script>

                            
<?php
    include_once('include/footer.php');
?>