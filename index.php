<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>AJAX - CRUD</title>

		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<script src="assets/vendor/jquery/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>

	</head>

	<body>

		<?php include "config/koneksi.php" ?>

		<h2 class="text-center bg-success p-2 text-white">DATA BARANG</h2>

		<div class="container-fluid mt-5">

			<div class="row">
				<div class="col-md-3">
					<button id="show" class="btn btn-success btn-block">Tambah Barang</button>
					<button id="hide" class="btn btn-danger btn-block" style="display: none;">Batal</button>

					<!-- form tambah data -->
					<div id="tambahdata" class="card mt-2 p-2" style="display: none;">
						<form id="formadd">

							<div class="form-group">
			                   <label for="">Nama Barang</label>
			                   <input type="text" class="form-control" name="nama" required>
			                </div>

							<div class="form-group">
			                   <label for="">Deskripsi</label>
			                   <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
			                </div>			                

							<div class="form-group">
			                   <label for="">Harga (Rp)</label>
			                   <input type="number" class="form-control" name="harga" required>
			                </div>		                

							<div class="form-group">
			                   <label for="">Stok</label>
			                   <input type="number" class="form-control" name="stok" required>
			                </div> 		                

							<div class="form-group">
								<button onclick="dataadd()" id="savebutton" class="btn btn-primary">Simpan</button>
			                </div>       

						</form>

					</div>

					<!-- form ubah data -->
					<div id="editdata" class="card mt-2 p-2" style="display: none;">
						<form id="formedit">
							<input type="hidden" name="editid">

							<div class="form-group">
			                   <label for="">Nama Barang</label>
			                   <input type="text" class="form-control" name="editnama" id="nama" required>
			                </div>

							<div class="form-group">
			                   <label for="">Deskripsi</label>
			                   <textarea name="editdeskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
			                </div>			                

							<div class="form-group">
			                   <label for="">Harga (Rp)</label>
			                   <input type="number" class="form-control" name="editharga" id="harga" required>
			                </div>		                

							<div class="form-group">
			                   <label for="">Stok</label>
			                   <input type="number" class="form-control" name="editstok" id="stok" required>
			                </div> 		                

							<div class="form-group">
								<button onclick="dataupdate()" id="updatebutton" class="btn btn-primary">Simpan</button>
								<button id="canceledit" class="btn btn-danger">Batal</button>
			                </div>       

						</form>

					</div>

				</div>

				<div class="col-md-9">
					
					<table class="table">
						<thead>
							<tr>
								<th>Nomor</th>
								<th>Nama Barang</th>
								<th>Deskripsi</th>
								<th>Harga</th>
								<th>Stok</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody id="databarang">
							
						</tbody>
					</table>

				</div>
			</div>		

		</div>

		<script>

			onload(); 

			function onload(){
			    let dataHandler = $('#databarang');
			    dataHandler.html("");

			    $.ajax({
			      type : "GET",
			      data : "",
			      url  : "process/dataall.php",

			      success : function(result) {
			        // console.log(result);
			        let dataresult = JSON.parse(result);
			        let nomor = 1;

			        $.each(dataresult, function(key, val){
			          let baris = $("<tr>");
			          baris.html("<td>"+ nomor++ +"</td><td>"+val.barang_nama+"</td><td>"+val.barang_deskripsi+"</td><td>"+val.barang_harga+"</td><td>"+val.barang_stok+"</td><td><button onclick='dataedit("+val.barang_id+")' class='btn btn-warning'>Edit</button> <button id='edit' onclick='datadelete("+val.barang_id+")' class='btn btn-danger'>Hapus</button></td>");
			          dataHandler.append(baris);
			        })
			        
			      }
			    })
			}

			function dataadd(){
				let nama      = $("[name = 'nama']").val();
				let deskripsi = $("[name = 'deskripsi']").val();
				let harga 	  = $("[name = 'harga']").val();
				let stok 	  = $("[name = 'stok']").val();

				$.ajax({
					type : "POST",
					data : "nama="+nama+"&deskripsi="+deskripsi+"&harga="+harga+"&stok="+stok+" ",
					url  : "process/dataadd.php",

					success : function(result) {
						console.log(result);
						// let objresult = JSON.parse(result);
						// $('#message').html(objresult.message);

						onload();
					}
				})
			}

			function dataedit(iddata) {	

		        $('#editdata').fadeIn(1000);
		        $('#show').hide();

		        let id = iddata;
		        $.ajax({
		        	type : "POST",
		        	data : "id="+id,
		        	url  : "process/datachoose.php",
		        	success : function(result) {
		        		// console.log(result);
		        		let data = JSON.parse(result);
		        		$("[name='editid']").val(data.barang_id);
		        		$("[name='editnama']").val(data.barang_nama);
		        		$("[name='editdeskripsi']").val(data.barang_deskripsi);
		        		$("[name='editharga']").val(data.barang_harga);
		        		$("[name='editstok']").val(data.barang_stok);
		        	}
		        })
			}

			function dataupdate() {				
				let id 		  = $("[name = 'editid']").val();
				let nama 	  = $("[name = 'editnama']").val();
				let deskripsi = $("[name = 'editdeskripsi']").val();
				let harga 	  = $("[name = 'editharga']").val();
				let stok 	  = $("[name = 'editstok']").val();

				$.ajax({
					type : "POST",
					data : "id="+id+"&nama="+nama+"&deskripsi="+deskripsi+"&harga="+harga+"&stok="+stok+" ",
					url  : "process/dataupdate.php",
					success : function(result) {
						var dataid = JSON.parse(result);
						console.log(dataid.message);

						onload();
					}
				})
			}

			function datadelete(id) {
				let iddata = id;
				let konfirmasi = confirm("Yakin Ingin Menghapus Data?");
				if (konfirmasi) {
					$.ajax({
						type : "POST",
						data : "id="+iddata,
						url  : "process/datadelete.php",

						success : function(result) {
							console.log(result);

							onload();
						}
					})
				}				
			}

		</script>
		
	</body>

</html>