<?php
require 'connection.php';

try{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validate = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $validate);
    $data = mysqli_num_rows($result);

    if($data > 0){
        session_start();
        $_SESSION['email'] = $email;
        header('Location:mahasiswa_middleware.php');
    }else{
        echo '<h3>Data not valid !</h3>';
        echo '<a href="index.php">Login</a>';
        exit();
    }
} catch(Exception $e){
    die('Ada kesalahan' . $conn->connection_error);
}
?>