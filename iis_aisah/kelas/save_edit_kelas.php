<?php

require '../../connection.php';
$errors = array();
$info = array();

if(empty($_POST['namakelasEdit']))
    $errors['nama'] = 'Nama kelas belum diisi';

if(empty($_POST['txtDosenEdit']))
    $errors['dosen'] = 'Nama Dosen belum diisi';


if( !empty($errors) ){
    $info['success'] = false;
    $info['errors'] = $errors;
}else{
    $data = array(
        'dosen_id' => $_POST['txtDosenEdit'],
        'nama_kelas' => $_POST['namakelasEdit']
    );
    $where = $_POST['txtIdEdit'];
    $cols = array();
    foreach ($data as $key => $value){
        $cols[] = "$key = '$value'";
    }
    // $dosen = $_POST['namadosenEdit'];
    // $id = $_POST['txtIdEdit'];
    $sql = "UPDATE kelas SET ". implode(',', $cols)." WHERE id=".$where;
    mysqli_query($conn, $sql);
    $info['success'] = true;
    $info['message'] = 'Updated';
}

echo json_encode($info);