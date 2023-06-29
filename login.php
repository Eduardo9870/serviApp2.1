<?php

$config = str_replace("login.php", "config.php", $_SERVER['SCRIPT_FILENAME']);
require_once($config);


if (isset($_POST['login'])) {
  $usernamelogin = $_POST['username'];
  $passwordlogin = md5($_POST['password']);
  $query = "SELECT * FROM user where username='" . $usernamelogin . "' and password= '" . $passwordlogin . "' ";
  $conn = mysqli_connect($host, $username, $password, $dbname);
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $row['username'] . "<br>";
    session_start();
    $_SESSION['id_user'] = $row['id'];
    header("Location: home.php");
  }
  echo '<div class="alert alert-danger" role="alert">
  Usuario o contraseña incorrecta
</div>
';
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
  <title>serviApp-Inicio de sesión</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">


</head>

<body class="container text-center">

  <div class="login-page bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <h3 class="mb-3">Inicio de sesión</h3>
          <div class="bg-white shadow rounded">
            <div class="row">
              <div class="col-md-7 pe-0">
                <div class="form-left h-100 py-5 px-5">
                  <form action="login.php" method="POST" class="row g-4">
                    <div class="col-12">
                      <label>Nombre de Usuario<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-text" type="text"><i class="bi bi-person-fill"></i></div>
                        <input type="text" class="form-control" name="username" placeholder="Ingresar nombre de usuario">
                      </div>
                    </div>

                    <div class="col-12">
                      <label>Contraseña<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-text"><i class=" bi bi-lock-fill"></i></div>
                        <input type="password" class="form-control" name="password" placeholder="Ingresar contraseña">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <a href="" class="float-end text-primary">Olvidaste tu contraseña?</a>
                    </div>

                    <div class="col-12">
                      <input type="submit" name="login" class="btn btn-primary px-4 float-end mt-4" value="Acceder">
                    </div>
                    <div>
                      <p>También puedes acceder con los siguientes medios:</p>
                      <div class="row-3">
                        <button class="btn-outline-primary rounded"><i class="bi bi-facebook"></i></button>
                        <button class="btn-outline-danger rounded"><i class="bi bi-google"></i></button>
                        <button class="btn-outline-info rounded"><i class="bi bi-twitter"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-5 ps-0 d-none d-md-block">
                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                  <i class="bi bi-emoji-smile-fill"></i>
                  <h2 class="fs-1">Bienvenido a serviApp</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->

</body>

</html>