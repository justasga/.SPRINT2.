<?php
  require_once "connect.php"; 
  $projektas = $_POST["projektas"];
  $sql = "insert into projektai (projectName) values ('$projektas')";
  $conn->query($sql);
  $conn->close();
  header("location:./?path=Projektai");
?>