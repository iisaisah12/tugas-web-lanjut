<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namakelas']))
    $errors['nama'] = 'Nama kelas belum diisi';

if(empty($_POST['txtDosen']))
    $errors['dosen'] = 'Nama Dosen belum diisi';


if(!empty($errors)){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $data = array(
        'dosen_id' => $_POST['txtDosen'],
        'nama_kelas' => $_POST['namakelas']
    );
    $key = array_keys($data);
    $val = array_values($data);
    // $dosen = $_POST['namakelas'];
    $sql = "INSERT INTO kelas (".implode(',', $key).")" ." VALUES('".implode("','", $val)."')";
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Tersimpan';
}

echo json_encode($info);