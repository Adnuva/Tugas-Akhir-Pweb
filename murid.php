  <?php
session_start();
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  include 'php/connect.php';
  $sql = "SELECT * FROM user WHERE id = '$id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $nama = $row['nama'];
  $nim = $row['nim'];
  $jenis_kelamin = $row['jenis_kelamin'];
  $jurusan = $row['jurusan'];
  $alamat = $row['alamat'];
  $id_wali = $row['id_wali'];
  $sql2 = "SELECT * FROM wali WHERE id = '$id_wali'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();
  $nama_wali = $row2['nama'];
?>
<html>

<head>
  <title>Simple Profile Page</title>
  <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

  <!-- Navbar -->
  <header>
    <div class="logo">
      <a href="#">Sistem Informasi Akademik</a>
    </div>
    <nav>
      <ul>
      <li><a href="php/logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>

  <div class="content">
    <div class="profile-section">
      <div class="container">
        <img src="assets/image/forprofile.png" class="profile-photo">
        <br>
        <br>
        <p class="profile-name"><?php echo $nama; ?></p>
        <br>
        <form action="update.php">
        <a href="edit.php?id=<?php echo $_SESSION['id'];?>"><button type="button" class="button profile-follow">Edit</button></a>
        </form>
      </div>
    </div>

    <div class="detail-section">
      <div class="container">

        <div class="card">
          <div class="container">
            <div class="card-title">
              Nim: <?php echo $nim; ?>
              <br>
              <br>
              Nama: <?php echo $nama; ?>
              <br>
              <br>
              Jenis Kelamin: <?php echo $jenis_kelamin; ?>
              <br>
              <br>
              Jurusan: <?php echo $jurusan; ?>
              <br>
              <br>
              Alamat: <?php echo $alamat; ?>
              <br>
              <br>
              Nama Wali: <?php echo $nama_wali; ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


</body>

</html>
<?php
 }  else {
    header("Location: index.php");
    exit();
}
?>