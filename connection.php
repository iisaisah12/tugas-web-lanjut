<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mahasiswalist';

$conn = new mysqli($server, $username, $password, $database);

if($conn->connect_error){
    die('Gagal terhubung' . $conn->connect_error);
}
else{
    
}
?>