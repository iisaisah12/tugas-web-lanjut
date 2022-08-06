<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namamhsEdit']))
    $errors['nama'] = 'Nama Mahasiswa belum diisi';

if(empty($_POST['txtKelasEdit']))
    $errors['kelas'] = 'Nama kelas belum diisi';


if( !empty($errors) ){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $data = array(
        'kelas_id' => $_POST['txtKelasEdit'],
        'nama_mhs' => $_POST['namamhsEdit']
    );
    $where = $_POST['txtIdEdit'];
    $cols = array();
    foreach ($data as $key => $value){
        $cols[] = "$key = '$value'";
    }
    // $dosen = $_POST['namadosenEdit'];
    // $id = $_POST['txtIdEdit'];
    $sql = "UPDATE mahasiswa SET ". implode(',', $cols)." WHERE id=".$where;
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Updated';
}

echo json_encode($info);