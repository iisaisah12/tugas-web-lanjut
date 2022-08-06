<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namadosenEdit'])){
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
    $dosen = $_POST['namadosenEdit'];
    $id = $_POST['txtIdEdit'];
    $sql = "UPDATE dosen SET nama_dosen='$dosen' WHERE id='$id'";
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Updated';
}

echo json_encode($info);