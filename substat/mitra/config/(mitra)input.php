<?php
	session_start();

    if(!isset($_SESSION['username'])){
    die("<script>alert('anda belum login');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="mitra"){
    die("Anda tidak memiliki hak akses!");
    }

	include '../../../include/connection.php';
    if (!$conn) {
        echo "GAGAL";
    }

	if (isset($_POST['submit'])) {

		$query 		= "SELECT max(id_progres) as maxId FROM progres";
		$result1 	= mysqli_query($conn,$query)or die("Error: " . mysqli_error($conn));
		$data 		= mysqli_fetch_array($result1);
		$id_progres = $data['maxId'];
		   
		$noId 		= (int) substr($id_progres, 3, 3);
		$noId++;

		$char 		= "PGR";

		$id_progres	= $char.sprintf("%03s",$noId);
		$id_order	= $_POST['id_order'];
		$ssurvey	= $_POST['ssurvey'];
		$spfisik	= $_POST['spfisik'];
		$nproject	= $_POST['nproject'];
		$sut		= $_POST['sut'];
		$namaodp	= $_POST['namaodp'];
		$keterangan	= $_POST['keterangan'];
		$nama_mitra = $_SESSION['nama'];
		$cek		= "SELECT* FROM progres WHERE id_order='$id_order'";
		$hasil		= mysqli_query($conn, $cek);
		if (mysqli_num_rows($hasil)>0) {
			echo "<script> alert('ID ORDER sudah ada! Tolong segera diproses!');window.location.href='../page1.php';</script>";
		}else{
			$sql		= "INSERT INTO progres VALUES ('$id_progres', '$id_order', '$nama_mitra', '$ssurvey', '$nproject', '$spfisik', '$sut','$namaodp', '$keterangan')";
			$result 	= mysqli_query($conn, $sql);
			$sql2     	= "UPDATE daftar_order SET nama_mitra='$nama_mitra', id_progres='$id_progres' WHERE id_order='$id_order'";
	        $result2  	= mysqli_query($conn,$sql2);
			if ($result) {
				echo "<script> alert('berhasil');window.location.href='../page1.php';</script>";			
				require_once('../../../PHPMailer/PHPMailerAutoload.php');
				$query 	= "SELECT * FROM daftar_order where id_order='$id_order'";
				$result = mysqli_query($conn, $query);
				while ($data=mysqli_fetch_assoc($result)) {
					$nama_user 	= $data['nama_user'];
					$query2 	= "SELECT * FROM user where nama='$nama_user'";
					$result2 	= mysqli_query($conn, $query2);
					while ($data=mysqli_fetch_assoc($result2)){
						$recipient=$data['email'];
					}
				}
	            $mail 				= new PHPMailer();
	            $mail->isSMTP();
	            $mail->SMTPAuth 	= true;
	            $mail->SMTPSecure 	= 'ssl';
	            $mail->Host 		= 'smtp.gmail.com';
	            $mail->Port 		= '465';
	            $mail->isHTML();
	            $mail->Username 	= 'optimawb@gmail.com';
	            $mail->Password 	= 'optimawb2018';
	            $mail->SetFrom ('no-reply@telkom.co.id');
	            $mail->Subject 		= '(SIMPRO) Ada progress baru dari mitra!';
	            $mail->Body = '<HTML>
							    <head>
							        <meta http-equiv="Content-Type" content="text/html;charset="utf-8"/>
							    </head>
							    <body>
								</table><br>
							        <h2>PROGRESS REPORT</h2>
							        <h4><strong>Inputan Terbaru dari mitra</strong></h4>
							        <table border="1">
							            <tr>
							                <th>ID Progress</th>
							                <th>ID Order</th>
							                <th>Nama Mitra</th>
							                <th>Status survey</th>
							                <th>Nama Project</th>
							                <th>Status Pekerjaan Fisik</th>
							                <th>Status UT</th>
							                <th>Nama  ODP</th>
							                <th>Keterangan</th>
							            </tr>
							                
						                <tr>
						                    <td>'.$id_progres.'</td>
						                    <td>'.$id_order.'</td>
						                    <td>'.$nama_mitra.'</td>
						                    <td>'.$ssurvey.'</td>
						                    <td>'.$spfisik.'</td>
						                    <td>'.$nproject.'</td>
						                    <td>'.$sut.'</td>
						                    <td>'.$namaodp.'</td>
						                    <td>'.$keterangan.'</td>
						                </tr>
							        </table>
							    </body>
							</HTML>';
	            $mail->AddAddress(''.$recipient.'');
	            $mail->Send();
			}
		}
	}else{
			echo "<script>alert('gagal');window.location.href='../page1.php';</script>";
		}
 ?>