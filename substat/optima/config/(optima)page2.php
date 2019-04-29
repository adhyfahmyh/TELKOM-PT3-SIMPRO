 <?php
	session_start();

    if(!isset($_SESSION['username'])){
    die("<script>alert('anda belum login');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="optima"){
    die("Anda tidak memiliki hak akses!");
    }

	include '../../../include/connection.php';
    if (!$conn) {
        echo "GAGAL";
    }

    if (isset($_POST['updatedata'])) {
	    $idproject	= $_POST['idproject'];
	    $witel		= $_POST['witel'];
	    $hsdatel 	= $_POST['hsdatel'];
	    $sto 		= $_POST['sto'];
	    $alamat 	= $_POST['alamat'];
	    $long 		= $_POST['long'];
	    $lat 		= $_POST['lat'];
	    $jml 		= $_POST['jml'];
	    $unsc 		= $_POST['unsc'];
	    $keterangan	= $_POST['keterangan'];
		$query="UPDATE pengajuan SET witel='$witel', infohs='$hsdatel', infosto='$sto', alamat='$alamat', koorlong='$long', koorlati='$lat', jodp='$jml', nounsc='$unsc', keterangan='$keterangan' WHERE idproject='$idproject'";
		$hasil=mysqli_query($conn, $query);
			if(!$hasil) {
	      		die ("<script>alert('Gagal!');window.location.href='../page2.php';</script>");
	   		}else{
	   			echo "<script>alert('Berhasil!');window.location.href='../page2.php';</script>";
	   		}

   	}

	if (isset($_POST['deletedata'])) {
	$id = $_POST['idproject'];
	$query = "DELETE FROM pengajuan WHERE idproject='$id'";
	$hasil_query = mysqli_query($conn, $query);
		if(!$hasil_query) {
			die ("<script>alert('Gagal!');window.location.href='../page2.php';</script>");
   		}else{
   			echo "<script>alert('Berhasil!');window.location.href='../page2.php';</script>";
   		}
	}
?>