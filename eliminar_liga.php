<?php
  include_once("clases/Database.php");

  $idLiga = $_GET['id'];
  $db = new Database();
  @mysqli_fetch_assoc($db->query("DELETE FROM liga WHERE id = '$idLiga'"));
  @mysqli_fetch_assoc($db->query("DELETE FROM equipo WHERE liga = '$idLiga'"));
  @mysqli_fetch_assoc($db->query("DELETE FROM usuarios WHERE id_liga = '$idLiga'"));

  rmdir('/liga/'.$idLiga);

  echo "<script>window.location='lista_liga.php';</script>";
?>
