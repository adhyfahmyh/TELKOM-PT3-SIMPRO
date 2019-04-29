<?php

//login config
    include 'connection.php';
    session_start();

    $username   = $_POST['username'];
    $psw        = md5($_POST['password']);
    $op         = $_GET['op'];
    $username   = mysqli_escape_string($conn,$username);
    $password   = mysqli_escape_string($conn,$psw);

    if($op=="in"){
        $cek = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$psw'");
        if(mysqli_num_rows($cek)==1){
            $c = mysqli_fetch_array($cek);
            $_SESSION['username']   = $c['username'];
            $_SESSION['status']     = $c['status'];
            $_SESSION['nama']       = $c['nama'];
            $_SESSION['id_user']    = $c['id_user'];
            $_SESSION['no_tel']     = $c['no_tel'];
            if($c['status']=="admin"){
                header("location:../substat/admin/admin.php");
            }else if($c['status']=="optima"){
                header("location:../substat/optima/optima.php");
            }else if($c['status']=="user"){
                header("location:../substat/user/user.php");
            }else if($c['status']=="mitra"){
                header("location:../substat/mitra/mitra.php");
            }
        }else{
            die('<div 
                style="text-align:center;
                width:400px;
                height:100px;
                background:red;
                position: absolute;
                top: 200;
                left: 500;
                border-radius:20px;
                box-shadow: 10px 10px 8px #888888;
                ">
                    <p style="
                        color:white;
                        font-size:25;
                    "><strong>Password/Username Salah</strong><p>
                    <a href="../logout.php" style="
                        -webkit-appearance: button;
                        -moz-appearance: button;
                        appearance: button;
                        text-decoration: none;
                        color: white;
                        background:green;
                        width:100px;
                        height:30px;
                        padding-top:10px;
                        border:none;
                        border-radius:10px;
                        box-shadow: 2px 0px 15px #888888;
                    ">Kembali</a>
                </div>');
        }
    }else if($op=="out"){
            unset($_SESSION['username']);
            unset($_SESSION['status']);
            header("location:../logout.php");
    }

?>