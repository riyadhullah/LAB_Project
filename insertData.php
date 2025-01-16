<?php
    $bookname = $_POST["bookName"] ?? "";
    $authorName = $_POST["authorName"] ?? "";
    $isbn = $_POST["isbn"] ?? "";
    $quantity = $_POST["quantity"] ?? "";
    $category = $_POST["category"] ?? "";

    $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");
    $query1 = "INSERT INTO bookrecords(bookName, authorName, isbn, quantity, category) VALUES('$bookname', '$authorName', '$isbn', '$quantity', '$category')";
    $query2 = "SELECT * FROM `bookrecords` WHERE `isbn` LIKE $isbn";

    
    $result2 = mysqli_query($conn,$query2);

    $rowCount = mysqli_num_rows($result2);
    if($rowCount<1)
    {
        $result = mysqli_query($conn,$query1);
        if($result)
        {
            echo "<h1>Data inserted successfully.</h1>";
        }
        else
        {
            echo "<h1>The data was not inserted. </h1>";
        }
    
        header("refresh: 2; url = index.php");
    }
    else
    {
        echo "<h1>Isbn number already exist. </h1>";
        header("refresh: 2; url = index.php");

    }
    


?>