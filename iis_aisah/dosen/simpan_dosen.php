<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namadosen'])){
    // alert('jalan');
    $errors['nama'] = 'Nama dosen belum diisi';
    // $dosen = $_POST['namadosen'];
    // $sql = "INSERT INTO dosen(nama_dosen) VALUES ('$dosen')";
    // mysqli_query($conn, $sql);
}

if( !empty($errors) ){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $dosen = $_POST['namadosen'];
    $sql = "INSERT INTO dosen(nama_dosen) VALUES ('$dosen')";
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Tersimpan';
}

echo json_encode($info);