<?php
    include 'dbConnection.php';
    $msg = '';
    $id = $_GET['completeid'];
    $status = 'completed';
    $sql = "UPDATE task SET id=$id,status='$status' WHERE id=$id";
    $result = mysqli_query($connect,$sql);
    header("location:index.php");
?>