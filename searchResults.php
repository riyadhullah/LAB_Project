<?php

        $isbn = $_POST['isbn'];
        $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

        $query = "SELECT * FROM `bookrecords` WHERE `isbn` LIKE $isbn";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $rowCount = mysqli_num_rows($result);
            
            if($rowCount>0)
            {
                $rows = mysqli_fetch_array($result);
                $bookname = $row["bookName"] ?? "";
                $authorName = $row["authorName"] ?? "";
                $isbn = $row["isbn"] ?? "";
                $quantity = $row["quantity"] ?? "";
                $category = $row["category"] ?? "";
                
                echo "<table class='table'>
                            <tr>
                                <th>ID</th>
                                <th>Book name</th>
                                <th>Author</th>
                                <th>Isbn</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>$rows[id]</td>
                                <td>$rows[bookName]</td>
                                <td>$rows[authorName]</td>
                                <td>$rows[isbn]</td>
                                <td>$rows[quantity]</td>
                                <td>$rows[category]</td>
                                <td>
                                        <a href='edit.php?id=$rows[id]' >Edit</a><br>
                                        <a href='delete.php?id=$rows[id]' >Delete</a>
                                </td>
                            </tr>

                        </table>";

            }
            else
            {
                echo "<h1 style='text-align: center;'>No books are available</h1>";
            }

        } else {
            echo "Query failed: " . mysqli_error($conn);
        }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>