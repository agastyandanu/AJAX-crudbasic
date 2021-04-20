<?php 
	include "../config/koneksi.php";

	$id = $_POST['id'];
	$result = array();

	$data = $koneksi->query("SELECT * FROM tb_barang WHERE barang_id = '$id' ")->fetch_assoc();

	$result = $data;

	echo json_encode($result);

?>