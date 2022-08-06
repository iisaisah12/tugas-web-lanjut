<?php

require '../../connection.php';

$id = $_POST['id'];

$sql = "SELECT id, nama_mhs, kelas_id FROM mahasiswa WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);

echo json_encode($data);