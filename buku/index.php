<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<title>SELAMAT DATANG</title>
<style>
.container{
	width:200px;
}
</style>
</head>
<body>
<div class="container">
<form action="" method="post" enctype="multipart/form-data" target="_self" id="login" name="login">
<input type="text" id="username" name="username" required placeholder="Username">
<input type="password" id="password" name="password" required placeholder="Password"><br>
<input type="checkbox" id="remember" name="remember"> 
Remember Me<br>
<button type="submit" name="submit" id="submit">Login</button>
<button type="reset" name="reset" id="reset">Cancel</button>
</form>
</div>
</body>
</html>
<?php
ob_flush();
?>