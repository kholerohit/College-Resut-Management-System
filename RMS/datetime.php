<?php
	date_dafault_timezone_set("Asia/Calcutta");
	$currentTime=time();
	$dateTime=strftime("%B-%d-%Y : %H:%M:%S",$currentTime);
	echo $dateTime;
?>
