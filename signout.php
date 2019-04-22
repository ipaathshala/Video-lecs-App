<?php
	session_start();
	require_once 'includes/DB_Functions.php';
	session_destroy();
	header("Location:index");
?>