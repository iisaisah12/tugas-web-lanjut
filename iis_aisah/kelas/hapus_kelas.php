<?php

require '../../connection.php';

$errors = array();
$info = array();

if(empty($_POST['id'])){
    $errors['id'] = 'ID Dosen tidak ditemukan';
}

if(!empty($errors)){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $id = $_POST['id'];
    $sql = "DELETE FROM kelas WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Data berhasil dihapus';
}

echo json_encode($info);