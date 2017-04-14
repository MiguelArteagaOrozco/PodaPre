<?php
    include_once('include/header.php');

    $hidden = "display-hide";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $newPassword = md5($_POST['password']);
        $query = "UPDATE usuarios SET password='$newPassword' WHERE id='1'";
        mysqli_fetch_assoc($db->query($query));
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
                                        <span class="caption-subject bold uppercase"> Cambiar password Administrador </span>
                                    </div>
                                </div>
                                <?php 
                                if(($_SERVER['REQUEST_METHOD'] == "POST") && $correct){ ?>
                                <div class="alert alert-success">
                                    <button class="close" data-close="alert"></button>
                                    <span> Password cambiado correctamente. </span>
                                </div>
                                <?php } ?>
                                <div class="portlet-body form">
                              
                                    <form role="form" class="form-horizontal" action="password-admin.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Contraseña</label>
                                                <div class="col-md-10">
                                                    <input type="password" step="any" class="form-control" name="password" id="form_control_pass1" placeholder="Ingrese la contraseña" required="required">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Repetir contraseña</label>
                                                <div class="col-md-10" id="div-password">
                                                    <input type="password" step="any" class="form-control" name="password2" id="form_control_pass2" placeholder="Ingrese nuevamente la contraseña " required="required" onblur="checkPass()">
                                                    <div class="form-control-focus"> </div>
                                                    <script type="text/javascript">
                                                function checkPass(){
                                                    var pass1 = document.getElementById("form_control_pass1");
                                                    var pass2 = document.getElementById("form_control_pass2");

                                                    if (pass1.value != pass2.value)
                                                    {
                                                        pass1.value = "";
                                                        pass1.placeholder = "Ingrese la contraseña;
                                                        pass2.value = "";
                                                        pass2.placeholder = "Ingrese nuevamente la contraseña";

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
                                                </div>
                                            </div>
                                            
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-5 col-md-10">
                                                    <button type="submit" class="btn blue">Cambiar password</button>
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