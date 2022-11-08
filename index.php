<?php
$msg = " ";
include 'dbConnection.php';
if(isset($_POST['submit']))
{
    $task = $_POST['task'];
    $status = 'pending';
    if(empty($task))
    {
        $msg = '<div class="alert alert-danger" role="alert">
        Please Enter a task!!
      </div>';
    }
    else{
        $sql = "INSERT INTO task(task,status) VALUES('$task','$status');";
        $result = mysqli_query($connect,$sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b41b9ec9a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="main-heading">
            <h1>To Do List</h1>
        </div>
        <div class="form">
            <form method="POST">
              <?php echo $msg; ?>
                <div class="form-group">
                  <input type="text" class="form-control" name="task" placeholder="Enter a new task">
                </div>
                <center><button type="submit" name="submit"class="btn btn-success">Add a New Task</button></center>
              </form>
        </div>
        <div class="table-control">
        <table class="table table-striped table-dark">
            <thead>
            </thead>
            <tbody>
            <?php
                $sql = "select * from task where status='pending'";
                $result = mysqli_query($connect,$sql);
                if($result)
                {
                    while($row= mysqli_fetch_assoc($result))
                    { 
                      $id = $row['id'];
                      $task = $row['task'];
                      $date = date('y-m-d'." \t(".' h:i:s '.")");
                      echo '<tr>
                        <td class="col-sm-2">
                          '.$date.'
                        </td>
                        <td class="col-sm-8">'.$task.'</td>
                        <td class="col-sm-1">
                          <a href="completeTask.php?completeid='.$id.'"><i class="fa-sharp fa-solid fa-check" id="complete"></i></a>
                        </td>
                        <td class="col-sm-1">
                          <a href="updateTask.php?updateid='.$id.'"><i class="fa-regular fa-pen-to-square" id="edit"></i></a>
                        </td>
                        <td class="col-sm-1">
                          <a href="deleteTask.php?deleteid='.$id.'"><i class="fa-solid fa-trash-can" id="delete"></i></a>
                        </td>
                      </tr>';
                    }
                }
            ?>      
            </tbody>
          </table>
        </div>
      </div>
      <div class="container">
        <div class="table-complete-control">
        <table class="table table-striped table-dark">
            <thead>
            <th class="col-sm-2"> </th>
            <th class="col-sm-8">Completed Tasks</th>
            <th class="col-sm-2"> </th>
            <th class="col-sm-2"> </th>
            </thead>
            <tbody>
            <?php
                $sql = "select * from task where status='completed'";
                $result = mysqli_query($connect,$sql);
                if($result)
                {
                    while($row= mysqli_fetch_assoc($result))
                    { 
                      $id = $row['id'];
                      $task = $row['task'];
                      $date = date('y-m-d'." (".' h:i:s '.")");
                      echo '<tr>
                        <td>
                          '.$date.'
                        </td>
                        <td>'.$task.'</td>
                        <td>
                          <i class="fa-regular fa-circle-check" id="complete"></i>
                        </td>
                        <td>
                          <a href="deleteTask.php?deleteid='.$id.'"<i class="fa-solid fa-trash-can" id="delete"></i>
                        </td>
                      </tr>';
                    }
                }
            ?>      
            </tbody>
          </table>
        </div>
      </div>
</body>
</html>