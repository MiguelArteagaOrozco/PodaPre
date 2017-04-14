<?php
    include_once('include/header.php');

    $hidden = "display-hide";
    $correct = false;
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);

        $result = mysqli_fetch_assoc($db->query("select * from usuarios where usuario = '$usuario' "));
        if(empty($result['id'])){
            $hidden = "display-hide";
        
            // Agrego el nombre de la liga
            @mysqli_fetch_assoc($db->query("INSERT INTO liga(nombre) VALUES ('$nombre')"));
            //Obtengo el nuevo ID
            $result = mysqli_fetch_assoc($db->query("SELECT max(id) as maximo FROM liga "));
            $idLiga = $result['maximo'];

            // Genero el nuevo usuario
            @mysqli_fetch_assoc($db->query("INSERT INTO usuarios(usuario,password,administrador,id_liga) VALUES ('$usuario', '$password', '0','$idLiga')"));
            
            // Guardo los equipos en un array y luego en la base
            $equiposArray = array();
            $i = 1;

            while (!empty($_POST['equipo_'.$i])){
                array_push($equiposArray, $_POST['equipo_'.$i]);
                $i++;
            }

            foreach ($equiposArray as $eq) 
            {
                @mysqli_fetch_assoc($db->query("INSERT INTO equipo(nombre,liga) VALUES ('$eq','$idLiga')"));
            }

            // Guardo las categorías en un array y luego en la base
            $categoriasArray = array();
            $i = 1;
            while (!empty($_POST['categoria_'.$i])) {
                array_push($categoriasArray, $_POST['categoria_'.$i]);
                $i++;
            }

            foreach ($categoriasArray as $cat) {
                @mysqli_fetch_assoc($db->query("INSERT INTO categoria(nombre,liga) VALUES ('$cat','$idLiga')"));
            }

            // Creo la carpeta para la liga, con permisos 777
            $old = umask(0);

            if (!file_exists('liga/'.$idLiga)) {
                mkdir('liga/'.$idLiga, 0777, true);
            }
            umask($old);
            $correct = true;
        }else{
            $hidden = "";
        }
    }
    
    
?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                    <div class="col-md-3">
                    </div>
                        <div class="col-md-6">
                            <div class="portlet light bordered">

                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> Agregar nueva liga </span>
                                    </div>
                                </div>
                                <?php 
                                if(($_SERVER['REQUEST_METHOD'] == "POST") && $correct){ ?>
                                <div class="alert alert-success">
                                    <button class="close" data-close="alert"></button>
                                    <span> Liga creada correctamente. </span>
                                </div>
                                <?php } ?>
                                <div class="portlet-body form">
                                <div class="alert alert-danger <?php echo $hidden; ?>">
                                    <button class="close" data-close="alert"></button>
                                    <span> Usuario repetido. </span>
                                </div>
                                    <form role="form" class="form-horizontal" action="agregar_liga.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Liga</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Ingrese el nombre de la liga" name="nombre" required="required">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Usuario</label>
                                                <div class="col-md-10">
                                                    <input type="text" step="any" class="form-control" name="usuario" id="form_control_1" placeholder="Ingrese el usuario de la liga" required="required">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Contraseña</label>
                                                <div class="col-md-10">
                                                    <input type="password" step="any" class="form-control" name="password" id="form_control_pass1" placeholder="Ingrese la contraseña de la liga" required="required">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Repetir contraseña</label>
                                                <div class="col-md-10" id="div-password">
                                                    <input type="password" step="any" class="form-control" name="password2" id="form_control_pass2" placeholder="Ingrese nuevamente la contraseña de la liga" required="required" onblur="checkPass()">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Categorías</label>
                                                <div class="col-md-10" id="lista-categorias">
                                                    <input type="text" class="form-control" id="form_control_1" placeholder="Ingrese el nombre de la categoría 1" name="categoria_1" required="required">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-md-offset-2 col-md-10" style="margin-top: 15px;">
                                                        <button type="button" class="btn blue" onclick="agregarCategoria()">Agregar otra categoría</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Equipos </label>
                                                <div class="col-md-10" id="lista-equipos">
                                                    <input type="text" class="form-control" placeholder="Ingrese el nombre del equipo 1" name="equipo_1" required="required"> 
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10" style="margin-top: 15px;">
                                                        <button type="button" class="btn blue" onclick="agregarEquipo()">Agregar otro equipo</button>
                                                    </div>
                                                </div>

                                                <script type="text/javascript">
                                                function checkPass(){
                                                    var pass1 = document.getElementById("form_control_pass1");
                                                    var pass2 = document.getElementById("form_control_pass2");

                                                    if (pass1.value != pass2.value)
                                                    {
                                                        pass1.value = "";
                                                        pass1.placeholder = "Ingrese la contraseña de la liga";
                                                        pass2.value = "";
                                                        pass2.placeholder = "Ingrese nuevamente la contraseña de la liga";

                                                        var alerta = document.createElement("div");
                                                        alerta.setAttribute("class", "alert alert-danger");

                                                        var boton = document.createElement("button");
                                                        boton.setAttribute("class", "close");
                                                        boton.setAttribute("data-close", "alert");

                                                        var span = document.createElement("span");
                                                        span.innerHTML = " ¡Las contraseñas no coinciden! ";

                                                        document.getElementById("div-password").appendChild(alerta);
                                                        alerta.appendChild(boton);
                                                        alerta.appendChild(span);
                                                    }
                                                }
                                                </script>

                                                <script type="text/javascript">
                                                    function agregarEquipo(){
                                                        if ( typeof agregarEquipo.i == 'undefined' )
                                                            agregarEquipo.i = 2;

                                                        var y = document.createElement("input");
                                                        y.setAttribute("type", "text");
                                                        y.setAttribute("class", "form-control")
                                                        y.setAttribute("placeholder", "Ingrese el nombre del equipo " + agregarEquipo.i);
                                                        y.setAttribute("name", "equipo_" + agregarEquipo.i);
                                                        y.setAttribute("required", "required");
                                                        document.getElementById("lista-equipos").appendChild(y);
                                                        agregarEquipo.i++;
                                                    }
                                                </script>
                                                <script type="text/javascript">
                                                    function agregarCategoria(){
                                                        if ( typeof agregarCategoria.i == 'undefined' )
                                                            agregarCategoria.i = 2;

                                                        var y = document.createElement("input");
                                                        y.setAttribute("type", "text");
                                                        y.setAttribute("class", "form-control")
                                                        y.setAttribute("placeholder", "Ingrese el nombre de la categoría " + agregarCategoria.i);
                                                        y.setAttribute("name", "categoria_" + agregarCategoria.i);
                                                        y.setAttribute("required", "required");
                                                        document.getElementById("lista-categorias").appendChild(y);
                                                        agregarCategoria.i++;
                                                    }
                                                </script>
                                            </div>

                                 
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-5 col-md-10">
                                                    <button type="submit" class="btn blue">Agregar Liga</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    include_once('include/footer.php');
?>