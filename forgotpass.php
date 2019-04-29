<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Forgot Password | SIMPRO</title>
        <link rel="icon" type="image/png" href="img/titleicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body class="gambar">
        <div class="hd"><h2><strong>Masukan email, lalu kode verifikasi dari email!</strong></h2></div>
        <div class="forgotpass">      
            <form method="POST" action="">
                <div class="grup">
                    <label> Email:  </label>
                    <input type="text"  name="email" placeholder="email@email.com"><br>
                    <input type="submit" value="Send Email" name="emailsend" class="tombol">
                </div>
                <div class="grup">
                    <label> Verification Code:  </label>
                    <input type="text" name="code" id="code" placeholder="Input Verification Code">
                </div>
                <div class="footer">
                    <input type="button" value="Kembali" onclick="location.href='logout.php';" >
                    <input type="submit" value="Reset Password" name="codesend" class="tombol">
                </div>
            </form>
        </div>
    </body>
<?php
session_start();
include 'include/connection.php';
if (isset($_POST['emailsend'])) {
    $email = $_POST['email'];
    $sql = "SELECT* FROM user WHERE email='$email'";
    $result = mysqli_query($conn,$sql);
    $data   = mysqli_fetch_assoc($result);
    if (!$data) {
        echo '<script type="text/javascript">alert("Email tidak terdaftar!");</script>';
    }else{
        $id_user    = $data['id_user'];
        $nama_user  = $data['nama'];
        $email      = $data['email'];
        $code       = substr(md5(mt_rand()),0,5);
        $sql2       = mysqli_query($conn, "INSERT INTO forgotpass VALUES ('','$id_user','$nama_user','$email','$code')");
        if ($sql2) {
            echo '<script type="text/javascript">alert("Kode verifikasi terkirim! Check email anda!");</script>';
                require_once('PHPMailer/PHPMailerAutoload.php');
                $mail               = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth     = true;
                $mail->SMTPSecure   = 'ssl';
                $mail->Host         = 'smtp.gmail.com';
                $mail->Port         = '465';
                $mail->isHTML();
                $mail->Username     = 'optimawb@gmail.com';
                $mail->Password     = 'optimawb2018';
                $mail->SetFrom ('no-reply@telkom.co.id');
                $mail->Subject      = 'Verification code';
                $mail->Body = '<!DOCTYPE html>
                                <html>
                                <head>
                                    <title></title>
                                    <style type="text/css">
                                    *{
                                    padding: 0;
                                    margin: 0;
                                    box-sizing: border-box;
                                    font-family: sans-serif;
                                    }
                                    div.content{
                                        background: #C21313;
                                        width: 150px;
                                        margin: 50px auto 0;
                                        border-radius: 16px;
                                        height: 50px;
                                        overflow: hidden;
                                    }
                                    div.content h1.title{
                                        text-align: center;
                                        color: white;
                                        font-weight: normal;
                                        line-height: 50px;
                                    }
                                    </style>
                                </head>                    
                                <body>
                                    <br><br>
                                    <h2 style="text-align: center;">Your Password Verification Code:</h2>
                                    <div class="content">
                                        <div class="head">
                                            <h1 class="title"><strong>'.$code.'</strong></h1>
                                        </div>
                                        
                                    </div>
                                </body>

                                </html>
                                ';
                $mail->AddAddress(''.$email.'');
                $mail->Send();               
        }    
}
    }elseif (isset($_POST['codesend'])){
        $code1   = $_POST['code'];
        $code1   = mysqli_escape_string($conn,$code1);
        $code2   = "SELECT * FROM forgotpass WHERE code='$code1'";  
        $result2 = mysqli_query($conn,$code2);
        $data2 = mysqli_fetch_assoc($result2); 
        if (!$data2) {
            echo '<script type="text/javascript">window.onload = function(){alert("SALAH!!");}</script>';
        }else{
            $id_user = $data2['id_user'];
            $query   = "SELECT * FROM user WHERE id_user='$id_user'";
            $result3 = mysqli_query($conn, $query);
            while($data3 = mysqli_fetch_assoc($result3)){
                $_SESSION['id_user'] = $data3['id_user'];
                header('location:resetpass.php');
            } 
        }          
    }
?>
</html>