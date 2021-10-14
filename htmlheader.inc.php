<?php
    if (!empty($_GET['logout'])) {
        session_unset();
    } 
?>


<!doctype html>
<html lang="HU">

<head>
    <meta charset="utf-8">
    <title>
        <?php
        echo $title;
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">



</head>


