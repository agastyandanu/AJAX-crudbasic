<?php 
	include "../config/koneksi.php";

	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$foto = "Foto";

	$update = $koneksi->query("UPDATE tb_barang SET barang_nama = '$nama', barang_deskripsi = '$deskripsi', barang_harga = '$harga', barang_stok = '$stok' WHERE barang_id = '$id' ");

	if ($update == TRUE) {
		$result['message'] = "Data Berhasil Diubah";
	} else {
		$result['message'] = "Data Gagal Diubah";
	}

	$result['id'] = $id;
	$result['nama'] = $nama;
	$result['stok'] = $stok;
	$result['harga'] = $harga;
	$result['deskripsi'] = $deskripsi;

	echo json_encode($result);

?>