<?php
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'amplifers';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database",$username,$password);
  } catch (PDOException $e) {
    die('Conexión fallida: ' . $e->getMessage());
  }
  $acentos = $conn->query("SET NAMES 'utf8'");
 ?>
