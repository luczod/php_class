<?php
include_once("helpers/url.php");
include_once("data/categories.php");
include_once("data/posts.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Code</title>
    <link rel="shortcut icon" href="<?= $BASE_URL ?>/img/logo.svg" type="image/x-svg">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/styles.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <a id="logo" href="<?= $BASE_URL ?>">
            <img src="<?= $BASE_URL ?>/img/logo.svg" alt="Blog code">
        </a>
        <nav>
            <ul id="navbar">
                <li><a href="<?= $BASE_URL ?>" class="nav-link">Home</a></li>
                <li><a href="<?= $BASE_URL ?>" class="nav-link">Categories</a></li>
                <li><a href="<?= $BASE_URL ?>" class="nav-link">About</a></li>
                <li><a href="<?= $BASE_URL ?>/contact.php" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </header>