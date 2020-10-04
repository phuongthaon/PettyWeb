<?php
	session_start();

	$_SESSION['cart'][] = $_POST['id'];
	$_SESSION['number'][] = $_POST['number'];
	$_SESSION['price'][] = $_POST['price'];
	echo sizeof($_SESSION['cart']);
?>