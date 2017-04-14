<?php
  function base64_to_jpeg($base64_string, $output_file)
  {
      $ifp = fopen($output_file, "wb"); 
      $data = explode(',', $base64_string);
      fwrite($ifp, base64_decode($data[1])); 
      fclose($ifp); 
      return $output_file; 
  }

  include_once('include/header.php');

  $idUser = $_SESSION['id'];
  include_once("clases/Database.php");
  $db = new Database();
  $result = mysqli_fetch_assoc($db->query("SELECT * from usuarios where id=  $idUser"));
  $idLiga = $result['id_liga'];

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $fechaNacimiento = $_POST['fecha_nacimiento'];
      $equipo = $_POST['equipo'];
      $dni = $_POST['dni'];
      $categoria = $_POST['categoria'];
      $extra = $_POST['extra'];
      $query = "INSERT INTO jugadores(nombre,apellido,fecha_nacimiento,dni,equipo,categoria,extra,id_liga) VALUES ('$nombre', '$apellido', '$fechaNacimiento', '$dni','$equipo' ,'$categoria','$extra','$idLiga')";
      //Agrego el jugador
      mysqli_fetch_assoc($db->query($query));

      $result = mysqli_fetch_assoc($db->query("SELECT max(id) as maximo FROM jugadores "));
      $idNuevo = $result['maximo'];
      if(empty($_FILES['imagenAttach']['name'])){
        $pathImg = "liga/".$idLiga."/".$idNuevo.".jpg";
        base64_to_jpeg($_POST['imagen'], $pathImg);
      }else{
        $tamano = $_FILES ['imagenAttach']['size'];
        $tamaño_max = "50000000000";
        if ($tamano < $tamaño_max) {
            $destino = "liga/".$idLiga;
            $sep = explode('image/', $_FILES["imagenAttach"]["type"]);
            $tipo = $sep[1];
            $a = move_uploaded_file($_FILES ['imagenAttach']['tmp_name'], $destino . '/' . $idNuevo . '.jpg');
        } else
            echo "El archivo supera el peso permitido.";
        }
      }
?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light bordered">
            <div class="portlet-title">
              <div class="caption font-green-haze">
                <span class="caption-subject bold uppercase">Agregar un nuevo jugador a la liga</span>
              </div>
            </div><?php 
                    if($_SERVER['REQUEST_METHOD'] == "POST"){ 
                  ?>
            <div class="alert alert-success">
              <span>Jugador agregado correctamente.</span>
            </div><?php } ?>

            <div class="portlet-body form">
              <form role="form" class="form-horizontal" action="nuevo_jugador.php"
              method="post" enctype="multipart/form-data">
                <input type="hidden" name="imagen" id="imagen" value="" />


                <div class="form-body col-md-4" style="margin:auto; text-align:center;"> <!-- col-md-6 -->
                  <div class="form-group form-md-line-input">

                    <h2 class="col-md-offset-2">Datos del jugador</h2>

                    <label class="col-md-2 control-label" for="form_control_1">Nombre</label>

                    <div class="col-md-10">
                      <input type="text" class="form-control" id="form_control_1" placeholder="Ingrese el nombre del jugador" name="nombre" required="required" />
                      <div class="form-control-focus"></div>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">Apellido</label>

                    <div class="col-md-10">
                      <input type="text" step="any" class="form-control" name="apellido" id="form_control_1" placeholder="Ingrese el apellido del jugador" required="required" />
                      <div class="form-control-focus"></div>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">Fecha de nacimiento</label>

                    <div class="col-md-10">
                      <input class="form-control" id="mask_date2" type="text" required="required" name="fecha_nacimiento" id="form_control_1" placeholder="Ingresar fecha de nacimiento" />
                      <div class="form-control-focus"></div>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">DNI</label>

                    <div class="col-md-10">
                      <input type="number" step="number" class="form-control" name="dni" id="form_control_1" placeholder="Ingrese el DNI del jugador" required="required" />
                      <div class="form-control-focus"></div>
                    </div>
                  </div>
                  
                  <div class="form-group form-md-line-input">
                      <label class="col-md-2 form-md-line-input">Extra</label>
                      <div class="col-md-9">
                          <input class="form-control" type="text" name="extra" />
                      </div>
                  </div>


                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">Categoría</label>

                    <div class="col-md-5">
                      <select class="form-control" name="categoria" id="form_control_1"> -->
                        <?php
                          $categorias = $db->query("select * from categoria where liga = '$idLiga'");
                          while($row = mysqli_fetch_array($categorias))
                          {
                            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                          }
                        ?>
                      </select>
                      <div class="form-control-focus"></div>
                    </div>
                  </div>
                    

                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">Equipo</label>

                    <div class="col-md-5">
                      <select class="form-control" name="equipo" id="form_control_1">
                        <?php
                          $equipos = $db->query("select * from equipo where liga = '$idLiga'");
                          while($row = mysqli_fetch_array($equipos))
                          {
                            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                          }
                        ?>
                      </select>
                      <div class="form-control-focus"></div>
                    </div>
                  </div>
                </div>

                <!-- Inicio foto webcam -->
                <div class="form-body col-md-4" style="text-align: center;">
          
                  <h2 class="col-md-offset-1">Tomate una foto</h2><br>
                  <div id="results"></div>
                  <div id="my_camera"></div>
                  <br>
                  <input type="button" value="Sacar foto" onclick="take_snapshot()" class="btn blue" id="btn-webcam" style="display: inline-block;" />

                </div>
                <!-- Fin foto webcam -->

                <!-- Inicio adjunta foto -->
                <div class="form-body col-md-4" style="text-align: center;"s>
                  
                  <h2 class="col-md-offset-1">Adjuntar una foto</h2><br>

                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 320px; height: 240px;">
                      <img src="img/no-adjunto.png" alt="" />
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 240px;"> </div>
                    <div>
                      <span class="btn default btn-file">
                        <span class="fileinput-new btn blue"> Seleccionar foto </span>
                        <span class="fileinput-exists btn blue"> Cambiar </span>
                        <input type="file" name="imagenAttach"> 
                      </span>
                      <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                    </div>
                  </div>
                  <div class="clearfix margin-top-10"> </div>

                </div>
                <!-- Fin adjuntar foto -->

                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-5 col-md-10">
                      <button type="submit" class="btn blue">Agregar jugador</button>
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

  
  <script src="assets/global/scripts/webcam.min.js" type="text/javascript" ></script>

  <script language="JavaScript">
    document.getElementById('results').innerHTML = '<img src="img/no-webcam.png"/>';

    navigator.getMedia = ( navigator.getUserMedia || // use the proper vendor prefix
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    navigator.getMedia({video: true}, function() {
      // Webcam is available
      Webcam.set({
          width: 320,
          height: 240,
          image_format: 'jpeg',
          jpeg_quality: 100,
          dest_width: 640,
          dest_height: 480
      });

      Webcam.attach( '#my_camera' );

      document.getElementById("my_camera").style = "width:320px; height:240px; margin:auto; margin-top:15px;";
      document.getElementById('results').innerHTML = '<img src="img/no-foto.png"/>';


    }, function() {
      // Wemcam is not available
      document.getElementById("btn-webcam").style.display = "none";
    });

  </script>

  <script language="JavaScript">
      function take_snapshot() {
          // take snapshot and get image data
          Webcam.snap( function(data_uri) {
              // display results in page
              document.getElementById('results').innerHTML = '<img src="'+data_uri+'" width=320 height=240/>';
              document.getElementById('imagen').value = data_uri;
          } );

      }
  </script>


<?php
  include_once('include/footer.php');
?>
