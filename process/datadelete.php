<?php 
	include "../config/koneksi.php";

	$id = $_POST['id'];

	$delete = $koneksi->query("DELETE FROM tb_barang WHERE barang_id = '$id' ");

	if ($delete) {
		$result['message'] = "Data Berhasil Dihapus";
	} else {
		$result['message'] = "Data Gagal Dihapus";
	}

	echo json_encode($result);

?>