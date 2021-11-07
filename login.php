<?php
ob_start();//mengaktifkan penghapusan buffer memory
include"koneksi.php";
if(!isset($_SESSION['user'])){
	session_start();
}

$pesan ="warning message";
if(isset($_POST['username'])){
	$user	=strip_tags(trim($_POST['username']));
	$pass	=strip_tags(trim($_POST['password']));
	$pass2	=sha1($pass);
	if(isset($_POST['remember'])){
		setcookie("username",$user,time() + (3600 * 24));
		setcookie("password",$pass,time() + (3600 * 24));
	}else{
			unset($_COOKIE['username']);
			unset($_COOKIE['password']);
	}
	//mengecek status user di database
	$query 			= "select * from user where username='$user' and password='$pass2'";
	$hasil			= mysql_query($query,$koneksi);
	$jumlah_user 	= mysql_num_rows($hasil);
	$data			= mysql_fetch_array($hasil);
	if($jumlah_user > 0){
		
		header("location:home.php");
		
		$_SESSION['user']=$data[2];
		$_SESSION['pass']=$data[3];
		$_SESSION['nama']=$data[1];
		$_SESSION['level']=$data[5];
		$_SESSION['foto']=$data[6];
		if($data[5] =='member'){
			header("location:index.php");
		}
		else if($data[5]=='admin' or $data[5]=='user'){
			header("location:admin.php");
		}
		
	}
	else{
		
	}
}
mysql_close($koneksi);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>login</title>
		<!-- file css -->
        <style>
            section{
                width: 250px;
                height: 300px;
                border-radius: 3px;
                border: solid 1px lightgray;
                margin: 0 auto;
                font-family: "calibri";
                font-size: 15px;
                margin-top: 100px;
            }
            section form{
                margin-left: 10px;
            }
            section input{
                width: 90%;
                height: 30px;
                border-radius: 3px;
                padding-left: 10px;
                border: solid 1px lightgray;
            }
            section button{
                border: 0;
                border-radius: 3px;
                width: 47%;
                height: 30px;
                color: white;
            }
            section button[type="submit"]{
                background: blue;
            }
            section button[type="button"]{
                background: green;
            }
            .pesan{
                width: 90%;
                height: 40px;
                border: solid 1px lightgray;
                border-radius: 3px;
                margin: 0 auto;
                font-family: "calibri";
                font-size: 12px;
                text-align: center;
                margin-top: 10px;
            }
            .foto{
                width: 100px;
                height: 100px;
                margin: 0 auto;
                border-radius: 5px;
                margin-top: -50px;
                border: solid 1px lightgray;
                background: #f8f8f8;
            }
            section input[type="checkbox"]{
                width: 0px;
                height: 0;
                margin-top: 10px;
                
            }
        </style>
		<!-- tutup css -->
    </head>
    <body>
        <section>
            <div class="foto">
			<img src="../img/logo.png" class="logo">
            </div>
            <div class="pesan">
                <?php echo $pesan; ?>
            </div>
            <form id="login" name="login" action="#" method="post" enctype="multipart/form-data"  target="_self">
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php echo isset($_COOKIE['username'])?$_COOKIE['username']:'';?>" required>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($_COOKIE['password'])?$_COOKIE['password']:'';?>" required>
                    <input type="checkbox" name="remember" id="remember"> Remember Me
                <br><br>
                <button type="submit" id="submit">Login</button>
                <a href="register.php"><button type="button" id="register">Register</button></a>
            </form>
        </section>
    </body>
</html>
<?php
ob_flush(); // mematikan seluruh program tereksekusi
?>