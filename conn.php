<?php
session_start();
$databaseHost = 'localhost';
$databaseName = 'id18974931_minifroz';
$databaseUsername = 'id18974931_siinoy42';
$databasePassword = 'Nakula_12345';

$connection = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$connection) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
