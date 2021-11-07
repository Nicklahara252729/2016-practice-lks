<?php
if(getenv('HTTP_X_FORWARDED_FOR')){
	$ipaddr	 = getenv('HTTP_X_FORWARDED_FOR');
}else{
	$ipaddr	 = getenv('REMOTE_ADDR');
}
$n  = gethostbyname($ipaddr);
echo $n;
?>