<?php
include_once('clases/Database.php');
$db = new Database();
$idLiga = $_GET['id'];

    
$ligas = $db->query("select * from liga where id='$idLiga'");
$ligaActual = mysqli_fetch_array($ligas);
$path = "liga/".$idLiga;
$rootPath = realpath($path);

$nombreZip = $idLiga."-".$ligaActual['nombre'].".zip";

$zip = new ZipArchive();
$zip->open($nombreZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);


foreach ($files as $name => $file)
{
    if (!$file->isDir())
    {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        $zip->addFile($filePath, $relativePath);

    }
}

$zip->close();

ob_get_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=" . basename($nombreZip) . ";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($nombreZip));
readfile($nombreZip);



unlink($nombreZip);

?>