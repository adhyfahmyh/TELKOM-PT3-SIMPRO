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
    if (isset($_POST['updatedata'])) {
    $id_progres = $_POST['id_progres'];
    $ssurvey 	= $_POST['ssurvey'];
    $nproject 	= $_POST['nproject'];
    $spfisik	= $_POST['spfisik'];
    $sut		= $_POST['sut'];
	$namaodp	= $_POST['namaodp'];
    $keterangan = $_POST['keterangan'];
    $nama_mitra = $_SESSION['nama'];
	$query="UPDATE progres SET  ssurvey='$ssurvey', nproject='$nproject', spfisik='$spfisik', sut='$sut', namaodp='$namaodp', keterangan='$keterangan' WHERE id_progres='$id_progres' ";
	$hasil=mysqli_query($conn, $query);
		if($hasil) {
      		echo "<script>alert('berhasil');window.location.href='../page.php';</script>";
                require_once('../../../PHPMailer/PHPMailerAutoload.php');
                $query = "SELECT * FROM optima where nmitra='$nama_mitra'";
                $result = mysqli_query($conn, $query);
                while ($data=mysqli_fetch_assoc($result)) {
                    $optima=$data['nama'];
                    $query2 = "SELECT * FROM user where nama='$optima'";
                    $result2 = mysqli_query($conn, $query2);
                    while ($data2=mysqli_fetch_assoc($result2)) {
                        $recipient=$data2['email'];
                    }
                }
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
                $mail->Subject = '(SIMPRO) Ada Update Progress dari Mitra!';
                $mail->Body =   '<HTML>
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html;charset="utf-8"/>
                                    </head>
                                    <body><br>
                                        <h2>PROGRESS REPORT</h2>
                                        <h4><strong>Update Terbaru dari mitra</strong></h4>
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
?>