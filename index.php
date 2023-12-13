<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header>
  <div class="logo">
      <a href="#">Sistem Informasi Siswa</a>
  </div>
  <nav>
      <ul>
          <li><a href="index.php">Login</a></li>
      </ul>
  </nav>
</header>


    <div class="containerrow mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login</h2>
                <form action="php/login.php" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <form action="php/connect.php">
                    <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            
            if (username === "" || password === "") {
                alert("Please fill in all fields");
                return false;
            }
        }
    </script>
</body>
</html>
