<?php

include_once 'psl-config.php';   // Needed because functions.php is not included

$mysqli = new mysqli('ftp', 'user', 'password', 'dbname');
if ($mysqli->connect_error) {
    header("Location: ../exception/error.php?err=Unable to connect to MySQL");
    exit();
}