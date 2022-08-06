<?php
require '../../connection.php';
?>

<?php
session_start();
if( ! isset($_SESSION['email'])){
    header("Location:../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Administrasi - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        .hidden{
            display:none;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DATA ADMINISTRASI MAHASISWA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

          <!--  Nav Item - Dashboard -->
            <!--<li class="nav-item"> 
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading"> </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Menu</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Select menus:</h6>
                        <a class="collapse-item" href="../../dosen_middleware.php">Dosen</a>
                        <a class="collapse-item" href="../../kelas_middleware.php">Kelas</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                    <i class="fas fa-fw"></i>
                    <span>logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            
            <!-- Main Content -->
            <div id="content">

                <section class="content-header">
                <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Mahasiswa</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <div class="row mb-3">
                                    <div class="my-3 col-6">
                                        <button class="btn btn-primary mx-3" data-toggle="modal" data-target="#staticBackdrop">
                                            Tambah Data
                                        </button>
                                        <!-- <a href="" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#adddosen">
                                            Tambah Dosen
                                        </a> -->
                                    </div>
                                </div>
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Nama Kelas</th>
                                                <th>Pembimbing Akademik</th>
                                                <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="alldata">
                                        <?php
                                        $sql = "SELECT mahasiswa.id, mahasiswa.kelas_id, mahasiswa.nama_mhs, kelas.dosen_id, kelas.nama_kelas, dosen.nama_dosen FROM mahasiswa INNER JOIN kelas ON kelas.id = mahasiswa.kelas_id INNER JOIN dosen ON dosen.id = kelas.dosen_id";
                                        $data = mysqli_query($conn, $sql);
                                        $no = (int)1;
                                        foreach ($data as $rows): ?>
                                        <tr>
                                            <th><?php echo $no++; ?></th>
                                            <td><?php echo $rows['nama_mhs'] ?></td>
                                            <td><?php echo $rows['nama_kelas'] ?></td>
                                            <td><?php echo $rows['nama_dosen'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div>
                                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="ganti(<?php echo $rows['id']; ?> )">edit</a>
                                                    </div>
                                                    <div class="mx-1">
                                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="hapus(<?php echo $rows['id']; ?>)">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tbody id="Content" class="searchdata"></tbody>
                                </table>
                                <!-- Modal Save -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Dosen</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" id="form_mhs">
                                                <label for="">Mahasiswa</label>
                                                <input type="text" id="nama" name="namamhs" class="form-control" placeholder="nama mahasiswa">
                                                <label for="">Kelas</label>
                                                <select name="txtKelas" id="kelas" class="form-control custom-select">
                                                    <option value="">Select Kelas</option>
                                                    <?php
                                                    $sql = "SELECT * FROM kelas";
                                                    $data = mysqli_query($conn, $sql);
                                                    ?>
                                                    <?php foreach($data as $opt): ?>
                                                        <?php echo '<option value="'.$opt['id'].'">'.$opt['nama_kelas'].'</option>'; ?>
                                                    <?php endforeach ?>
                                                </select>
                                                <input type="hidden" name="txtId">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="save" onclick="simpan()">Save</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Dosen</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" id="form_mhsEdit">
                                                <label for="">Mahasiswa</label>
                                                <input type="text" id="nama" name="namamhsEdit" class="form-control" placeholder="nama mahasiswa">
                                                <label for="">Kelas</label>
                                                <select name="txtKelasEdit" id="kelas" class="form-control custom-select">
                                                    <option value="">Select Kelas</option>
                                                    <?php
                                                    $sql = "SELECT * FROM kelas";
                                                    $data = mysqli_query($conn, $sql);
                                                    ?>
                                                    <?php foreach($data as $opt): ?>
                                                        <?php echo '<option value="'.$opt['id'].'">'.$opt['nama_kelas'].'</option>'; ?>
                                                    <?php endforeach ?>
                                                </select>
                                                <input type="hidden" name="txtIdEdit">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="edit" onclick="edit()">Edit</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->

                </section>

            </div>
            <!-- End of Main Content -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        function simpan(){
            $.ajax({
                url : '../mahasiswa/simpan_mhs.php',
                type : 'POST',
                dataType: 'JSON',
                data : $('#form_mhs').serialize(),
                success:function(data){
                    if(!data.success){
                        if(data.errors.nama){
                            alert(data.errors.nama);
                            $('#nama').focus();
                            return false;
                        }
                        if(data.errors.kelas){
                            alert(data.errors.kelas);
                            $('#kelas').focus();
                            return false;
                        }
                    }else{
                        alert(data.message);
                        window.location.reload();
                    }
                }
            })
        }

        function ganti(id){
            $('#editModal').modal('show');
            $.ajax({
                url : '../mahasiswa/edit_mahasiswa.php',
                type: 'POST',
                dataType: 'JSON',
                data : { id : id },
                success:function(data){
                    $('input[name="namamhsEdit"]').val(data.nama_mhs);
                    $('select[name="txtKelasEdit"]').val(data.kelas_id);
                    $('input[name="txtIdEdit"]').val(data.id);
                }
            })
        }

        function edit(){
            $.ajax({
                url : '../mahasiswa/save_edit_mahasiswa.php',
                type : 'POST',
                dataType: 'JSON',
                data : $('#form_mhsEdit').serialize(),
                success:function(data){
                    if(!data.success){
                        if(data.errors.nama){
                            alert(data.errors.nama);
                            $('#nama').focus();
                            return false;
                        }
                        if(data.errors.kelas){
                            alert(data.errors.kelas);
                            $('#kelas').focus();
                            return false;
                        }
                    }else{
                        alert(data.message);
                        window.location.reload();
                    }
                }
            })
        }

        function hapus(id){
            if(confirm('Hapus data ini ?')){
                $.ajax({
                    url : '../mahasiswa/hapus_mahasiswa.php',
                    type : 'POST',
                    dataType: 'JSON',
                    data : {id : id},
                    success:function(data){
                        if(!data.success){
                            alert(data.errors.id);
                            return false;
                        }else{
                            alert(data.message);
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>

</body>

</html>