<?php 
    include "../includes/dbConn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $task = $_POST['task'];
        $task_date = date("Y-m-d H:i:s");
    
        $sql = "INSERT INTO tasks (task_details, task_date) VALUES ('$task', '$task_date')";
    
        if (mysqli_query($conn , $sql)) {
            echo "Task added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
?>