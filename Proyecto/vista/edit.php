<?php
include("../controlador/conect2.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];


    $sentencia = "UPDATE users SET Username='$user', Pass='$pass', rol='$rol' where id='$id'";
    $resent = $conn->query($sentencia);

    if ($resent == null) {
        echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
        echo "<script>location.href='new.php'</script>";
    } else {
        echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';

        echo "<script>location.href='new.php'</script>";
    }
} else {
    $id = $_GET["id"];

    $sql = $conn->query("SELECT * FROM users WHERE id=$id");

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $user = $row['Username'];
        $pass = $row['Pass'];
        $rol = $row['rol'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
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
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php" method="post">
                    Id<br><input class="form-control-sm form-control" type="text" name="id" class="" value="<?php echo $id ?>" readonly><br>
                    User<br> <input type="text" name="user" value="<?php echo $user ?>"><br>
                    Password<br> <input type="text" name="pass" value="<?php echo $pass ?>"><br>
                    Rol<br>
                    <select name="rol" value="<?php echo $rol ?>">
                        <option value="admin"> admin </option>
                        <option value="none"> none </option>
                    </select><br>
                    <br>
                    <input type="submit" value="Guardar" name="update" class="btn btn-success btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>