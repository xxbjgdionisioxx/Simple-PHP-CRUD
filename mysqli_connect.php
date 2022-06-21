<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'activityko';

$abc = mysqli_connect($servername,$username,$password,$dbname);

if(!$abc)
{
    die("Connection Failed:".mysqli_connect_error());
}

?>