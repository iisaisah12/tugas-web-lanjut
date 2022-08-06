<?php
require 'connection.php';
session_start();
?>

<?php if( ! isset($_SESSION['email'])): ?>
    <h3> Silahkan Login !</h3>
    <a href="index.php">Login</a>

<?php else: ?>
    <?php 
    header('Location:iis_aisah/mahasiswa/blank.php'); 
    ?>

<?php endif ?>