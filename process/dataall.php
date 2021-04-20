<?php 
	
	include "../config/koneksi.php";

	$alldata = $koneksi->query("SELECT * FROM tb_barang");

	while ($data = $alldata->fetch_assoc()) {
		$result[] = $data;
	}

	echo json_encode($result);

?>