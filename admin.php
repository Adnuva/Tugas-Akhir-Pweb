<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
include 'php/connect.php';
$nim        = "";
$nama       = "";
$jenis_kelamin = "";
$jurusan    = "";
$alamat     = "";
$nama_wali  = "";
$sukses     = "";
$error      = "";
$emailU     = "";
$passwordU  = "";

if (isset($_GET['stat'])) {
    $stat = $_GET['stat'];
} else {
    $stat = "";
}
if ($stat == 'delete') {
    $id         = $_GET['id'];
    $sqlD       = "delete from user where id = '$id'";
    $del         = mysqli_query($conn, $sqlD);
    $sqlD2       = "delete from wali where id = '$id'";
    $del2         = mysqli_query($conn, $sqlD2);
    if ($del2 && $del) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal menghapus data";
    }
}
if ($stat == 'edit') {
    $id         = $_GET['id'];
    $sqlE       = "select * from user where id = '$id'";
    $edite        = mysqli_query($conn, $sqlE);
    $rw1         = mysqli_fetch_array($edite);
    $emailU = $rw1['email'];
    $passwordU = $rw1['password'];
    $nim        = $rw1['nim'];
    $nama       = $rw1['nama'];
    $jenis_kelamin = $rw1['jenis_kelamin'];
    $jurusan    = $rw1['jurusan'];
    $alamat     = $rw1['alamat'];
    $id_wali    = $rw1['id_wali'];
    $sqlget     = "select * from wali where id = '$id_wali'";
    $get        = mysqli_query($conn, $sqlget);
    $reg         = mysqli_fetch_array($get);
    if ($reg == 0) {
        $nama_wali = "-";
    } else {
        $nama_wali  = $reg['nama'];
    }

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) {
    $sql44 = "SELECT * FROM wali";
    $query44 = mysqli_query($conn, $sql44);
    $getId = mysqli_num_rows($query44);
    $getIdw = 1 + $getId;
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan    = $_POST['jurusan'];
    $alamat     = $_POST['alamat'];
    $nama_wali  = $_POST['nama_wali'];
    $passwordU  = $_POST['passwordU'];
    $emailU     = $_POST['emailU'];

    if ($nim && $nama && $jenis_kelamin && $jurusan && $alamat && $nama_wali && $emailU && $passwordU) {
        if ($stat == 'edit') {
            $sqlU = "UPDATE user SET email='$emailU',password='$passwordU',nim='$nim', nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', alamat='$alamat' WHERE id=$id";
            $query1 = mysqli_query($conn, $sqlU);

            $sql3 = "SELECT * FROM wali WHERE id=$id_wali";
            $query3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($query3);
            if (mysqli_num_rows($query3) < 1) {
                $sql4 = "INSERT INTO wali (nama) VALUES ('$nama_wali')";
                $query4 = mysqli_query($conn, $sql4);
            } else {
                $sqlU2 = "UPDATE wali SET nama='$nama_wali' WHERE id=$id_wali";
                $query22 = mysqli_query($conn, $sqlU2);    
            }


            if ($query1 && $query3) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else {
            $sql1   = "insert into user(email,password,nim,nama,jenis_kelamin,jurusan,alamat,id_wali,role) values ('$emailU', '$passwordU', '$nim','$nama','$jenis_kelamin','$jurusan' ,'$alamat','$getIdw' ,'murid')";
            $q1     = mysqli_query($conn, $sql1);
            $sqll   = "insert into wali (nama) values ('$nama_wali')";
            $qq     = mysqli_query($conn, $sqll);
            if ($q1 && $qq) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 900px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<header>
    <div class="logo">
      <a href="#">Sistem Informasi Siswa</a>
    </div>
    <nav>
      <ul>
        <li><a href="php/logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>


    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:4;url=admin.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:4;url=admin.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="emailU" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="emailU" name="emailU" value="<?php echo $emailU ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="passwordU" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="passwordU" name="passwordU" value="<?php echo $passwordU ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">- Pilihan -</option>
                                <option value="Laki-Laki" <?php if ($jenis_kelamin == "Laki-Laki") echo "selected" ?>>Laki - Laki</option>
                                <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected" ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $jurusan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10"><?php echo $alamat ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_wali" class="col-sm-2 col-form-label">Nama Wali</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo $nama_wali ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nama Wali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from user where role = 'murid' order by id desc";
                        $q2     = mysqli_query($conn, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $emailU     = $r2['email'];
                            $passwordU  = $r2['password'];
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $jenis_kelamin = $r2['jenis_kelamin'];
                            $jurusan    = $r2['jurusan'];
                            $alamat     = $r2['alamat'];
                            $id_wali    = $r2['id_wali'];
                            $sql3       = "select * from wali where id = '$id_wali'";
                            $q3         = mysqli_query($conn, $sql3);
                            $r3         = mysqli_fetch_array($q3);
                            if ($r3 == 0) {
                                $nama_wali = "-";
                            } else {
                                $nama_wali  = $r3['nama'];
                            }

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $emailU ?></td>
                                <td scope="row"><?php echo $passwordU ?></td>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $jenis_kelamin ?></td>
                                <td scope="row"><?php echo $jurusan ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $nama_wali ?></td>
                                <td scope="row">
                                    <a href="admin.php?stat=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="admin.php?stat=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>

</html>