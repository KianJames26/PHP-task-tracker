<?php
  include '../includes/dbConn.php';

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $taskId = $_POST['taskId'];

    $sql = "UPDATE `tasks` SET isDone = !isDone WHERE `tasks`.`task_id` = '$taskId'";
    if (mysqli_query($conn, $sql)) {
      echo "Task added successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
?>