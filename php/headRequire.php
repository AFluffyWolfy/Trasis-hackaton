<?php

session_start();

if (isset($_SESSION['islog']) && !$_SESSION['islog']) {
    header('location: ../php/disconnect.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if (isset($title)) {echo $title;} ?></title>
    <link rel="stylesheet" href="../html/stylesheet/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

