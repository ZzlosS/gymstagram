<?php
    require_once 'functions.php';
    if(!isset($_POST['id'])){die("<script>location.replace('home.php')</script>");}
    $id = $_POST['id'];
    $role = $_POST['selector'];
    qM("UPDATE `members` SET `role` = $role WHERE `id`=$id");
    echo "<script>location.replace('member_control.php')</script>";