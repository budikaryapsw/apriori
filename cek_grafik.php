<?php
include_once "database.php";
include_once "mining.php";
$db_object = new database();
    $tgl = $_POST['tanggal'];  
    $tgl2 = $_POST['tanggal2'];  
	$hasil= mining_grafik($db_object,$tgl,$tgl2);
    echo json_encode($hasil);
?>