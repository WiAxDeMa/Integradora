<?php require '../controlador/conect2.php';
	$message='';

	if(!empty($_POST['user']) && !empty($_POST['pass'])){

		$checkUser = $conn->prepare("SELECT * FROM users WHERE Username=?");
		$checkUser->execute([$_POST['user']]);
        $user = $checkUser->fetch();
        
		if ($user==0) {
                $sql = "INSERT INTO users (Username, Pass, rol) VALUES (:user, :pass, 'none')";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':user', $_POST['user']);
                $stmt->bindParam(':pass', $_POST['pass']);
            
                if ($stmt->execute()) {
                    echo "<script> alert('Usuario creado satisfactoriamente');
                    window.location.href='/proyecto/index.php'; </script>";
                } else {
                    echo "<script> alert('Error creando el usuario, intente de nuevo') </script";
                }
            }
            else{
                echo "<script> alert('Usuario ya registrado') </script>";
            }
                }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="vista/css/style.css"> -->
</head>

<body>
    <div class="container mt-5">
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h2 class="card-title">Registro</h2>
                <form action="registro.php" method="POST">
                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="text" class="form-control" name="user">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="pass">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
                <a href="../index.php" >
          <input type="button" value="Volver" class="btn btn-danger mt-2" style="width:100px; position:relative;"> </input> </a>

            </div>
        </div>

    </div>

    <div id="scripts">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script>
            if (typeof($.fn.modal) === 'undefined') {
                document.write('<script src="/js/bootstrap.min.js"><\/script>')
            }
        </script>

    </div>
</body>

</html>