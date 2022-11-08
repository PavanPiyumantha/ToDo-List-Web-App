<?php
    include 'dbConnection.php';
    if(isset($_GET['deleteid']))
    {
        $id = $_GET['deleteid'];
        $sql = "delete from task where id=$id";
        $result = mysqli_query($connect,$sql);
        if($result)
        {
            header('location:index.php');
        }
        else
        {
            die(mysqli_error($connet));
        }
    }
?>