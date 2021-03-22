<?php
  require_once "connect.php"; 
  $name = $_POST["name"];
  $sql = "insert into darbuotojai (Vardas) values ('$name')";
  $conn->query($sql);
  $conn->close();
  header("location:./?path=Darbuotojai");
?>