<?php 
	include "../config/koneksi.php";

	$nama 	   = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$harga 	   = $_POST['harga'];
	$stok 	   = $_POST['stok'];

	$save = $koneksi->query("INSERT INTO tb_barang (barang_nama, barang_deskripsi, barang_harga, barang_stok) VALUES ('$nama', '$deskripsi', '$harga', '$stok') ");

	if ($save == TRUE) {
		$result['message'] = "Data Berhasil Disimpan";
	} else {
		$result['message'] = "Data Gagal Disimpan";
	}

	echo json_encode($result);

?>