<?php
  include "../includes/dbConn.php";

  $sql = "SELECT * FROM tasks";
  $result = mysqli_query($conn, $sql);
  $tasks = [];

  if(mysqli_num_rows($result) > 0){
    while($res = mysqli_fetch_assoc($result)){
      array_push($tasks, $res);
    }
    header('Content-type: application/json');
    echo json_encode($tasks);
  }
  $conn->close();
?>