<?php

 include_once("clases/Database.php");
 $db = new Database();


$idLiga = $_GET['id'];
$path = "liga/".$idLiga;
$rootPath = realpath($path);


$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);


$filesToDelete = array();

foreach ($files as $name => $file){
	$filePath = $file->getRealPath();
	$filesToDelete[] = $filePath;
}

foreach ($filesToDelete as $file)
{
    @unlink($file);
}

@mysqli_fetch_assoc($db->query("DELETE FROM jugadores WHERE id_liga = '$idLiga'"));

echo "<script>window.location='lista_liga.php';</script>";

?>