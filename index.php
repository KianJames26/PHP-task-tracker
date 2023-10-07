<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Task Tracker</title>
</head>
<body>
  <script>
    $(document).ready(function(){
      $("#task-form").submit(function(event){
        event.preventDefault();
        const taskValue = $("#task").val();
        if(!taskValue.trim()){
          $("#error-message").text("Task couldn't be empty");
          $(".prompt").css("display", "flex");
        }else{
          var task = $("#task").val();
          $.ajax({
            type: "POST",
            url: "controller/addTask.php",
            data: { task: task },
            success: function(response) {
              alert(response);
              $("#task").val("");
              fetchTask();
            },
            error: function(xhr, status, error) {
              alert(error);
            }
          });
        }
      })

      $("#task").on("input",function(){
        $("#error-message").text("");
        $(".prompt").css("display", "none");
      })
      function fetchTask(){
        $(".tasks").empty();
        $.ajax({
          type:"GET",
          url: "controller/fetchTask.php",
          success: function(response){
            $.each(response, function(key, value){
              if(value['isDone'] === '1'){
                $(".tasks").append(
                  `<div class="task task-done" id="enclosure${value['task_id']}">
                    <input type="checkbox" name="task${value['task_id']}" id="task${value['task_id']}" class="task-checkbox" onclick="toggleStatus(${value['task_id']})" checked>
                    <label for="task${value['task_id']}">${value['task_details']}</label>
                    <button><img src="assets/img/trash.png" alt="Delete"></button>
                  </div>`
                )
              }else{
                $(".tasks").append(
                  `<div class="task" id="enclosure${value['task_id']}">
                    <input type="checkbox" name="task${value['task_id']}" id="task${value['task_id']}" class="task-checkbox" onclick="toggleStatus(${value['task_id']})">
                    <label for="task${value['task_id']}">${value['task_details']}</label>
                    <button><img src="assets/img/trash.png" alt="Delete"></button>
                  </div>`
                )
              }
            })
          }
        })
      }
      fetchTask();
    })
  </script>
  <h1>Task Tracker</h1>
  <form id="task-form" autocomplete="off">
    <div class="form">
      <input type="text" name="task" id="task" placeholder="Enter new task">
      <button type="submit" id="submit-task">
        <img src="assets/img/add.png" alt="Add">
      </button>
    </div>
  </form>
  <div class="prompt" id="prompt">
    <img src="assets/img/warning.png" alt="Error!">
    <p id="error-message"></p>
  </div>
  <div class="tasks"></div>
  <script>
  function toggleStatus(id){
    $(`#enclosure${id}`).toggleClass("task-done");
    $.ajax({
      type: "POST",
      url: "controller/toggleTaskStatus.php",
      data: { taskId : id, },
      success: function(response) {
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    })
  }
  </script>
</body>
</html>