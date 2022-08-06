<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namamhs']))
    $errors['nama'] = 'Nama Mahasiswa belum diisi';

if(empty($_POST['txtKelas']))
    $errors['kelas'] = 'Nama Kelas belum diisi';


if(!empty($errors)){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $data = array(
        'kelas_id' => $_POST['txtKelas'],
        'nama_mhs' => $_POST['namamhs']
    );
    $key = array_keys($data);
    $val = array_values($data);
    // $dosen = $_POST['namakelas'];
    $sql = "INSERT INTO mahasiswa (".implode(',', $key).")" ." VALUES('".implode("','", $val)."')";
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Tersimpan';
}

echo json_encode($info);