<?php
$mysql_hostname = "localhost";
$mysql_user = "fefe_mlmdb";
$mysql_password = "4qGx#zH2^7S(";
$mysql_database = "fefe_mlmdb";
$prefix = "";
$mysqli = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>