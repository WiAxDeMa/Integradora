<?php
session_start();
if (isset($_SESSION['Username'])) {
  header('location:vista/new.php');
}
$alert = '';
require 'controlador/conect2.php';

if (!empty($_POST)) {

  if (empty($_POST['usu']) || empty($_POST['contra'])) {
    $alert = 'Favor ingresar usuario y contrasenia';
  } else {

    $records = $conn->prepare('SELECT * FROM users WHERE Username=:Username AND Pass=:Pass');
    $records->bindParam(':Username', $_POST['usu']);
    $records->bindParam(':Pass', $_POST['contra']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $col = $records->rowcount();

    if ($col > 0) {
      session_start();
      $_SESSION['active'] = true;
      $_SESSION['Username'] = $results['Username'];
      $_SESSION['Pass'] = $results['Pass'];
      $_SESSION['rol'] = $results['rol'];

      header('location: vista/new.php');
    } else {
      $alert = 'Credenciales incorrectas';
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Welcome</title>
  <link rel="stylesheet" type="text/css" href="vista/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="vista/img/1.png">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <img class="wave" src="vista/img/wave.png">
  <div class="container">
    <div class="img">
      <img src="vista/img/bg.svg">
    </div>

    <div class="login-content">
      <form action="index.php" method="post">
        <img src="vista/img/avatar.svg">
        <h2 class="title">Amplifire</h2>
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <h5>Usuarios</h5>
            <input type="text" name='usu'>
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <h5>Contraseña</h5>
            <input type="password" name='contra'>
          </div>
        </div>
        <a href="modelo/registro.php">Registrate</a>
        <a href="#">Olvidé mi contraseña</a>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="submit" class="btn" value="Login">
      </form>
    </div>
  </div>
  <script type='text/javascript' src='controlador/js/main.js'></script>
</body>

</html>