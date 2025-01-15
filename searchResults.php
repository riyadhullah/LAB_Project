<?php

        $bookName = $_POST['bookName'];
        $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

        $query = "SELECT * FROM `bookrecords` WHERE `bookName` LIKE '$bookName'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $rowCount = mysqli_num_rows($result);
            
            if($rowCount>0)
            {
                $rows = mysqli_fetch_array($result);

                echo "<h1 style='text-align: center;'>$rows[quantity] books are available</h1>";
            }

        } else {
            echo "Query failed: " . mysqli_error($conn);
        }

    
?>