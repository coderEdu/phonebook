<?php
session_start();

if ($_GET) {
	$id = $_GET['id'];
	include_once "db.php";
	switch ($_GET['which']) {
		case 'contact': mysqli_query($conn, "DELETE FROM people WHERE id = '$id'"); break;
		case 'note': mysqli_query($conn, "DELETE FROM notes WHERE id = '$id'"); break;
	}
	$_SESSION['message']='deleted';
}

header("Location: ".$_SERVER['HTTP_REFERER']);
?>