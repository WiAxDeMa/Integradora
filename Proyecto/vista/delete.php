<?php
include("../controlador/conect2.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM users WHERE id = $id";
  $stm = $conn->prepare($sql);
  $result = $stm->execute();

  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: new.php');
}

?>