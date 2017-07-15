<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Генератор</title>
</head>
<body>
<?php

$dbA='aes-256-cbc';
$ivsize=openssl_cipher_iv_length($dbA);
$iv = openssl_random_pseudo_bytes($ivsize, $strong);
$key = openssl_random_pseudo_bytes($ivsize, $strong);
if($strong)
{
?>
	<pre>
	$dbGlobalKey = base64_decode('<?php echo base64_encode($key); ?>');
	$dbGlobalIv = base64_decode('<?php echo base64_encode($iv); ?>');
	</pre>
<?php
}
	else
{
	echo "Невозможно создать ключ";
}
?>
</body>
</head>
