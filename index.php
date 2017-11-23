<?php
	include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Input Data</title>
</head>
<body>
	<h2>Silahkan Input Data</h2>
    <a href="data.php">Data</a>
    <form action="" method="post" enctype="multipart/form-data">
    	<table>
        	<tr>
            	<td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama"/></td>
            </tr>
            <tr>
            	<td>File</td>
                <td>:</td>
                <td><input type="file" name="gambar"/></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
                <td><input type="submit" name="kirim" value="Kirim"/></td>
            </tr>
    	</table>
	</form>
    
    <?php
		if(isset($_POST['kirim'])){
			$nama = $_POST['nama'];
			$nama_file = $_FILES['gambar']['name'];
			$source = $_FILES['gambar']['tmp_name'];
			$folder = './uploads/';
			
			move_uploaded_file($source, $folder.$nama_file);
			$insert = mysqli_query($conn, "INSERT INTO tb_gambar VALUES(
			NULL, 
			'$nama', 
			'$nama_file')");
			if($insert){
				echo 'Berhasil Upload';
			}else{
				echo'Gagal Upload';
			}
		}
	?>
</body>
</html>