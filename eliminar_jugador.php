<?php
include_once("clases/Database.php");

$idJugador = $_GET['id'];
$db = new Database();
$result = mysqli_fetch_assoc($db->query("SELECT * FROM jugadores WHERE id = '$idJugador'"));
$idLiga = $result['id_liga'];
mysqli_fetch_assoc($db->query("DELETE FROM jugadores WHERE id = '$idJugador'"));

unlink($_SERVER['DOCUMENT_ROOT']."/v3/liga/".$idLiga."/".$idJugador.".jpg");

echo "<script>window.location='listado_jugadores.php';</script>";
