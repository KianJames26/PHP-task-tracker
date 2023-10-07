<?php
  include "../includes/dbConn.php";

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $taskId = $_POST['taskId'];

    $sql = "DELETE FROM `tasks` WHERE `tasks`.`task_id` = $taskId";
    if (mysqli_query($conn, $sql)) {
      echo "Task added successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
?>