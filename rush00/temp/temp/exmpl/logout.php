<?php
	session_start();
	$_SESSION['authorized_user'] = NULL;
	session_destroy();
	header("Location: index.php",TRUE,301);
?>
