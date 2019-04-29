<?php     
    session_start();

    if(!isset($_SESSION['username'])){
    die("<script>alert('anda belum login');window.location.href='../index.php';</script>");
    }

    if($_SESSION['status']!="optima"){
    die("Anda tidak memiliki hak akses!");
    }

	include '../../../include/connection.php';
	if (!$conn) {
		echo "GAGAL";
    }

	$query     = "SELECT max(id_order) as maxId FROM optima";
	$result1   = mysqli_query($conn,$query)or die("Error: " . mysqli_error($conn));
	$data      = mysqli_fetch_array($result1);
	$id_order  = $data['maxId'];
	   
	$noId      = (int) substr($id_order, 3, 3);
	$noId++;

	$char      = "ODR";
	$localzone = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

	$id_order  = $char . sprintf("%03s", $noId);
	$idproject = $_POST['idproject'];
    $nmitra    = $_POST['nmitra'];
    $nama      = $_SESSION['nama'];
    $notelp    = $_SESSION['no_tel'];
    $tglorder  = $localzone->format('d/m/y, h:i:s');
    
    
    if (isset($_POST['submit'])) {
		$sql= "INSERT INTO optima (`id_order`, `idproject`, `nmitra`, `nama`, `notelp`, `tglorder`) VALUES ('$id_order', '$idproject', '$nmitra', '$nama', '$notelp', '$tglorder')";		
		$result = mysqli_query($conn, $sql);
        $sql2     = "UPDATE daftar_order SET nama_optima='$nama', id_order='$id_order' WHERE idproject='$idproject'";
        $result2  = mysqli_query($conn,$sql2);
            
            if($result){
                // $_SESSION['pesan'] = 'ada input data';
                echo "<script>alert('berhasil');window.location.href='../page1.php';</script>";
                require_once('../../../PHPMailer/PHPMailerAutoload.php');
                    $query = "SELECT * FROM user where nama = '$nmitra' AND status = 'mitra'";
                    $result = mysqli_query($conn, $query);
                    while ($data=mysqli_fetch_assoc($result)) {
                        $receiver=$data['email'];
                        $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = '465';
                    $mail->isHTML();
                    $mail->Username = 'optimawb@gmail.com';
                    $mail->Password = 'optimawb2018';
                    $mail->SetFrom ('no-reply@telkom.com');
                    $mail->Subject = '(SIMPRO) Ada permintaan dari optima!';
                    $mail->Body = '<HTML>
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html;charset="utf-8"/>
                                    </head>
                                    <body>
                                    <h2>Permintaan ALPRO</h2>
                                    <table border="1">
                                         <tr>
                                            <th>ID Order</th>
                                            <th>ID Project</th>
                                            <th>Nama Mitra</th>
                                            <th>Nama Optima</th>
                                            <th>No. Telp Optima</th>
                                            <th>Waktu Order</th>
                                            <th>Tanggal Go Live</th>
                                        </tr>
                                                
                                            <tr>
                                                <td>'.$id_order.'</td>
                                                <td>'.$idproject.'</td>
                                                <td>'.$nmitra.'</td>
                                                <td>'.$nama.'</td>
                                                <td>'.$notelp.'</td>
                                                <td>'.$tglorder.'</td>
                                                <td>"Belum GO LIVE"</td>
                                            </tr>
                                        </table>
                                    </body>
                                </HTML>';
                    $mail->AddAddress(''.$receiver.'');
                    $mail->Send();
                    }

            }else{
                echo "<script>alert('gagal');window.location.href='../page1.php';</script>";
            }
    }

?>