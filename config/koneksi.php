<?php 
	
	$koneksi = mysqli_connect("localhost", "root", "", "db_barang");

	if (!$koneksi) {
		echo "Failed Connect To Database";
	}

?>