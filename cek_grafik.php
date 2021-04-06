<?php
include_once "database.php";
include_once "mining.php";
$db_object = new database();
    $tgl = $_POST['tanggal'];   
	$hasil= mining_grafik($db_object,$tgl);
    echo json_encode($hasil);
?>