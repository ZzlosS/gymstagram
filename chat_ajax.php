<?php
require_once 'functions.php';
$id = $_POST['id'];
$result = qM("SELECT * FROM `profile` WHERE `id`=$id");
$row = $result->fetch_assoc();
$name = $row['name'];
$lname = $row['last_name'];
$info = $row['information'];
$pic = $row['pic_path'];

$returnArr = [$name,$pic,$info,$lname];
echo json_encode($returnArr);
?>
