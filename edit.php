<?php
	include 'db.php';
	
	$data = mysqli_query($conn, "SELECT * FROM tb_gambar WHERE id_gambar ='".$_GET['id']."'");
	$r = mysqli_fetch_array($data);
	
	$nama = $r['nama'];
	$file = $r['file'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Edit Data</title>
</head>
<body>
	<h2>Silahkan Edit Data</h2>
    <a href="data.php">Data</a>
    <form action="" method="post" enctype="multipart/form-data">
    	<table>
        	<tr>
            	<td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?php echo $nama ?>"/></td>
            </tr>
            <tr>
            	<td>File</td>
                <td>:</td>
                <td>
                <input type="hidden" name="img" value="<?php echo $file ?>" />
                <input type="file" name="gambar"/>
                </td>
            </tr>
             <tr>
            	<td></td>
                <td></td>
                <td><img src="uploads/<?php echo $file ?>" width="100px" height="100px" /></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
                <td><input type="submit" name="kirim" value="Update"/></td>
            </tr>
    	</table>
	</form>
    
    <?php
		if(isset($_POST['kirim'])){
			$nama = $_POST['nama'];
			$nama_file = $_FILES['gambar']['name'];
			$source = $_FILES['gambar']['tmp_name'];
			$folder = './uploads/';
			
			if($nama_file !=''){
				move_uploaded_file($source, $folder.$nama_file);
				$update = mysqli_query($conn, "UPDATE tb_gambar SET 
					nama ='".$nama."',
					file ='".$nama_file."'
					WHERE id_gambar = '".$_GET['id']."';
					");
					if($update){
						echo 'Berhasil diperbaruhi';
					}else{
						echo 'Gagal diperbaruhi';
					}
			}else{
				$update = mysqli_query($conn, "UPDATE tb_gambar SET 
					nama ='".$nama."'
					WHERE id_gambar = '".$_GET['id']."';
					");
					if($update){
						echo 'Berhasil diperbaruhi';
					}else{
						echo 'Gagal diperbaruhi';
					} 
			}
		}
	?>
</body>
</html>