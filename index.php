<?php
    $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

    $query = "select * from bookrecords";

    $result = mysqli_query($conn, $query);
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
                            echo $key; 
                            echo "<br>";
                        }
                    }
                ?>
            </div>
            <div class="mid">
                <div class="mid1">
                    <div class="mid11">                 <!-- --------------------------------------------     -->
                        <table class="table">

                            <tr>
                                <td>ID</td>
                                <td>Book name</td>
                                <td>Author</td>
                                <td>Isbn</td>
                                <td>Quantity</td>
                                <td>Category</td>
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
                    <div class="mid12"></div>
                </div>
                <div class="mid2">
                    <div class="mid21"><img src ="book01.jpg" class="img_center"></div>
                    <div class="mid22"><img src ="book01.jpg" class="img_center"></div>
                    <div class="mid23"><img src ="book01.jpg" class="img_center"></div>
                </div>
                <div class="mid3">
                    <form style="text-align: center;" action="insertData.php" method="post">
                        <h4>Book Insertion</h4>
                        Book name: <input type="Text" placeholder="Enter book name" name="bookName" id="bookName"><br><br>
                        Author   : <input type="Text" placeholder="Enter author name" name="authorName" id="authorName"><br><br>
                        Isbn     : <input type="Text" placeholder="Enter isbn" name="isbn" id="isbn"><br><br>
                        Quantity : <input type="Text" placeholder="Enter quantity" name="quantity" id="quantity"><br><br>
                        Category : <input type="Text" placeholder="Enter category" name="category" id="category"><br><br>
                        <input type="submit" name="submit" id="submit">
                    </form>
                </div>
                <div class="mid4">
                    <div class="mid41">
                        <form style="text-align: center;" action="Process.php" method="post">
                            <h2 style="text-align: center;">Borrow Form</h2>

                            <label>Full Name:</label>
                            <input type="text" placeholder="Enter you name" name="name" id ="name" required>
                            <br><br>

                            <label>AIUB ID:</label>
                            <input type="text" placeholder="xx-xxxxx-x" name="id" id="id" required>
                            <br><br>

                            <label>Email:</label>
                            <input type="text" placeholder="Enter you Email" name="email" id="email" required>
                            <br><br>

                            <label>BookList:</label>
                            <select name="book" id="book" required>
                                <option value="" disabled selected>Select a Book</option>
                                
                                <option >Book2</option>
                                <option value="Book3">Book3</option>
                                <option value="Book4">Book4</option>
                                <option value="Book5">Book5</option>
                                <option value="Book6">Book6</option>
                                <option value="Book7">Book7</option>
                                <option value="Book8">Book8</option>

                                <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<option value='{$row['bookName']}'>{$row['bookName']}</option>";
                                    }
                                ?>
                            </select>
                            <br><br>

                            <label >Borrow date:</label>
                            <input type="date" name="borrowDate" id="borrowDate" required>
                            <br><br>

                            <label > Token</label>
                            <input type="number" id="token" name="token" min="0" value="0">
                            <br><br>

                            <label >Return Date</label>
                            <input type="date" id="returnDate" name="returnDate" required>
                            <br><br>
                            
                            <label >Fees</label>
                            <input type="number" id="fees" name="fees" min="0" step="10" value="0" >
                            <br><br>

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

            </div>
        </div>
    </div>
</body>
</html>