<?php
session_start();
require '../controlador/conect2.php';

if (isset($_SESSION['Username'])) {
	$records = $conn->prepare('SELECT * FROM users WHERE Username=:id');
	$records->bindParam(':id', $_SESSION['Username']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = null;

	if (count((array) $results) > 0) {
		$user = $results;
	}
} else {
	echo "<script>alert('Credenciales incorrectas');
      window.location.href='/Proyecto';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Welcome</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="vista/img/1.png">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
	<?php
	if ($_SESSION['rol'] == "admin") {
	?>
		<div class="container ">
			<H1>Bienvenido Admin</H1>
			<a href="/Proyecto/modelo/logout.php">Logout</a>
			<h2> Administración de usuarios registrados</h2>
			<hr class="soft" />
			<h4>Tabla de Usuarios</h4>
			<table class='table table-hover' ;>
				<tr class="warning">
					<th>id</th>
					<th>User</th>
					<th>Password</th>
					<th>Rol</th>
					<th>Editar</th>
				</tr>
				<?php
				$sql = $conn->prepare("SELECT * FROM users");
				$sql->execute();
				while ($usuarios = $sql->fetch(PDO::FETCH_ASSOC)) {
				?>
					<tr>
						<td><?php echo $usuarios['id'] ?> </td>
						<td><?php echo $usuarios['Username'] ?> </td>
						<td><?php echo $usuarios['Pass'] ?> </td>
						<td><?php echo $usuarios['rol'] ?> </td>
						<td>
							<a href="edit.php?id=<?php echo $usuarios['id'] ?>" class="btn btn-secondary">
								<i class="fas fa-marker"></i>
							</a>
							<a href="delete.php?id=<?php echo $usuarios['id'] ?>" class="btn btn-danger">
								<i class="far fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
		</div>
	<?php } else { ?>
		<h1>Bienvenido Usuario</h1>
		<a href="/Proyecto/modelo/logout.php">Logout</a>
	<?php } ?>
</body>

</html>