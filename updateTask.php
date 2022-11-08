<?php
    include 'dbConnection.php';
    $msg = '';
    $id = $_GET['updateid'];
    $sql = "select * from task where id=$id";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    $task_show = $row['task'];
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
        else
        {
            $sql = "UPDATE task SET id=$id, task='$task',status='$status' WHERE id=$id";
            $result = mysqli_query($connect,$sql);
            $msg = '<div class="alert alert-success" role="alert">Successfully Updated task!!</div>';
            header("location:index.php");
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
                  <input type="text" class="form-control" name="task" value=<?php echo $task_show  ?> placeholder="Enter a new task">
                </div>
                <center><button type="submit" name="submit"class="btn btn-success">Update Task</button></center>
              </form>
        </div>
        <div class="table-control">
        <table class="table table-striped table-dark">
            <thead>
            </thead>
            <tbody>
            <?php
                $id = $_GET['updateid'];
                $sql = "select * from task where id=$id";
                $result = mysqli_query($connect,$sql);
                if($result)
                {
                  $id = $row['id'];
                  $task = $row['task'];
                  $date = date('y-m-d'." (".' h:i:s '.")");
                  echo '<tr>
                    <td class="col-sm-2">
                      '.$date.'
                    </td>
                    <td class="col-sm-8">'.$task.'</td>
                  </tr>';
                }
            ?>      
            </tbody>
          </table>
        </div>
    </div>
</body>
</html>