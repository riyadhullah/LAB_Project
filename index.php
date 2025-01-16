<?php
    $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

    $query = "select * from bookrecords";

    $result = mysqli_query($conn, $query);
    $result1 = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Borrowing Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="h1">Book Borrowing Management</h1>
    <div class="fullBody">
        <div class="img">
            <img src ="ID.png" class="img_center">
        </div>
        <div class="div1">
            <div class="left">
                <h5>Used Token</h5>
                <?php
                    //$usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                    if(file_exists("data.json"))
                    {
                        $usedToken = json_decode(file_get_contents("data.json"), true);
                    
                        foreach ($usedToken as $key)
                        {
                            echo "<div class='token-box'>$key</div>";
                        }
                    }
                ?>
            </div>
            <div class="mid">
                <div class="mid1">
                    <div class="mid11">                 <!-- --------------------------------------------     -->
                        <table class="table">

                            <tr>
                                <th>ID</th>
                                <th>Book name</th>
                                <th>Author</th>
                                <th>Isbn</th>
                                <th>Quantity</th>
                                <th>Category</th>
                            </tr>
                            <?php
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>
                                    <td>$row[id]</td>
                                    <td>$row[bookName]</td>
                                    <td>$row[authorName]</td>
                                    <td>$row[isbn]</td>
                                    <td>$row[quantity]</td>
                                    <td>$row[category]</td>
                                    </tr>";
                                }
                                
                            ?>
                            

                        </table>
                    </div>
                    <div class="mid12">
                        <table class="table">

                            <tr>
                                <th>ID</th>
                                <th>Book name</th>
                                <th>Author</th>
                                <th>Isbn</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                while($rows = mysqli_fetch_assoc($result1))
                                {
                                    echo "<tr>
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
                                    </tr>";
                                }
                                
                            ?>

                        </table>
                    </div>
                </div>
                <div class="mid2">
                    <div class="mid21"><img src ="book01.jpg" class="img_center"></div>
                    <div class="mid22"><img src ="book01.jpg" class="img_center"></div>
                    <div class="mid23"><img src ="book01.jpg" class="img_center"></div>
                </div>
                <div class="mid3">
                    <form style="text-align: center;" action="insertData.php" method="post">
                        <h4>Book Insertion</h4>
                        Book name: <input type="Text" placeholder="Enter book name" name="bookName" id="bookName" required>
                        Author   : <input type="Text" placeholder="Enter author name" name="authorName" id="authorName" required>
                        Isbn     : <input type="Text" placeholder="Enter isbn" name="isbn" id="isbn" required>
                        Quantity : <input type="Text" placeholder="Enter quantity" name="quantity" id="quantity" required>
                        Category : <input type="Text" placeholder="Enter category" name="category" id="category" required>
                        <input type="submit" name="submit" id="submit">
                    </form>
                </div>
                <div class="mid4">
                    <div class="mid41">
                        <form style="text-align: center;" action="Process.php" method="post">
                            <h2 style="text-align: center;">Borrow Form</h2>

                            <label>Full Name:</label>
                            <input type="text" placeholder="Enter you name" name="name" id ="name" required>

                            <label>AIUB ID:</label>
                            <input type="text" placeholder="xx-xxxxx-x" name="id" id="id" required>

                            <label>Email:</label>
                            <input type="text" placeholder="Enter you Email" name="email" id="email" required>

                            <label>BookList:</label>
                            <select name="book" id="book" required>
                                <option value="" disabled selected>Select a Book</option>
                                
                                <?php
                                    while($row = mysqli_fetch_assoc($result2))
                                    {
                                        echo "<option value='{$row['bookName']}'>{$row['bookName']}</option>";
                                    }
                                ?>
                            </select>

                            <label >Borrow date:</label>
                            <input type="date" name="borrowDate" id="borrowDate" required>

                            <label > Token</label>
                            <input type="number" id="token" name="token" min="0" value="0">

                            <label >Return Date</label>
                            <input type="date" id="returnDate" name="returnDate" required>
                            
                            <label >Fees</label>
                            <input type="number" id="fees" name="fees" min="0" step="10" value="0" >

                            <input type="submit" name="submit" value="Submit">



                        </form>
                    </div>
                    <div class="mid42">
                        <h3>TOKEN</h3>
                        <?php
                            if(file_exists("token.json"))
                            {
                                $token = json_decode(file_get_contents("token.json"), true);
                            
                                foreach ($token[0]["token"] as $key)
                                {
                                    echo $key; 
                                    echo "<br>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="right">
            <form action="searchResults.php" method="POST">
                <label for="search">Search:</label>
                <input type="text" id="isbn" name="isbn" placeholder="Enter isbn number" required>
                <button type="submit">Search</button>
            </form>
            </div>
        </div>
    </div>
</body>
</html>