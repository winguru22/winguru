<?php
session_start();

$db_host="localhost";
$db_username="root";
$db_pass="";
$db_name="colgame";

$conn = mysqli_connect("$db_host","$db_username","$db_pass","$db_name") or die("error occurred");
$uid = $_SESSION['_id'];
$sql = "DELETE FROM `active_sessions` WHERE USER_ID = $uid"; 
$result = mysqli_query($conn, $sql);
 session_destroy();
 header("Location:./login.php");
				 exit();
?>
