<?php
    if(isset($_GET["id"]))
    {
        $id = $_GET['id'];
        $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

        $query = "DELETE FROM bookrecords WHERE id=$id";
        //$query = "DELETE FROM bookrecords WHERE `bookrecords`.`id` = $id";
        mysqli_query($conn, $query);

    }

    header("refresh: 0.5; url = index.php");
    exit;
?>