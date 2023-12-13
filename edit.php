<?php
session_start();
include 'php/connect.php';
$id = $_GET['id'];
$id2 = $_SESSION['id'];
$sukses = "";
$error = "";

$sql = "SELECT * FROM user WHERE id=$id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
} else if ($id != $id2) {
    die("data tidak ditemukan...");
}

$nis = $row['nis'];
$nama = $row['nama'];
$jenis_kelamin = $row['jenis_kelamin'];
$jurusan = $row['jurusan'];
$alamat = $row['alamat'];
$id_wali = $row['id_wali'];
$sql2 = "SELECT * FROM wali WHERE id=$id_wali";
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($query2);
if (mysqli_num_rows($query2) < 1) {
    $nama_wali = "";
} else {
    $nama_wali = $row2['nama'];
}

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $nama_wali = $_POST['nama_wali'];

    $sql = "UPDATE user SET nim='$nis', nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', alamat='$alamat' WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    $sql3 = "SELECT * FROM wali WHERE id=$id_wali";
    $query3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($query3);
    if (mysqli_num_rows($query3) < 1) {
        $sql4 = "INSERT INTO wali (nama) VALUES ('$nama_wali')";
        $query4 = mysqli_query($conn, $sql4);
    } else {
        $sql2 = "UPDATE wali SET nama='$nama_wali' WHERE id=$id_wali";
        $query2 = mysqli_query($conn, $sql2);
    }

    if ($query && $query3) {
        $sukses = "Data berhasil diupdate";
    } else {
        $error = "Data gagal diupdate";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:4;url=edit.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:3;url=murid.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIS</label>
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
                                <option value="Laki-laki" <?php if ($jenis_kelamin == "Laki-Laki") echo "selected" ?>>Laki - Laki</option>
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
                            <input type="submit" name="update" value="Update Data" class="btn btn-primary" />
                        </div>
                </form>
            </div>
        </div>

</html>