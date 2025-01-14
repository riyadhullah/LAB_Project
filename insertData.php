<?php
    $bookname = $_POST["bookName"] ?? "";
    $authorName = $_POST["authorName"] ?? "";
    $isbn = $_POST["isbn"] ?? "";
    $quantity = $_POST["quantity"] ?? "";
    $category = $_POST["category"] ?? "";

    $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");
    $query = "INSERT INTO bookrecords(bookName, authorName, isbn, quantity, category) VALUES('$bookname', '$authorName', '$isbn', '$quantity', '$category')";

    $result = mysqli_query($conn,$query);

    if($result)
    {
        echo "<h1>Data inserted successfully.</h1>";
    }
    else
    {
        echo "<h1>The data was not inserted. </h1>";
    }

    header("refresh: 2; url = index.php");


?>