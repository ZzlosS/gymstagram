<?php
require_once 'functions.php';
$id = $_POST['id'];
$result = qM("SELECT * FROM `members` WHERE `id`=$id");
$row = $result->fetch_assoc();
$name = $row['name'];
$lname = $row['lname'];
$info = $row['information'];
$pic = $row['pic_path'];

$returnArr = [$name,$pic,$info,$lname];
echo json_encode($returnArr);
?>
