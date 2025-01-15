<?php
if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["id"]))
    {
        $id = $_GET['id'];
        $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

        $query = "select * from bookrecords where id=$id";
        //$query = "DELETE FROM bookrecords WHERE `bookrecords`.`id` = $id";
        $result3 = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result3);

        $bookname = $row["bookName"] ?? "";
        $authorName = $row["authorName"] ?? "";
        $isbn = $row["isbn"] ?? "";
        $quantity = $row["quantity"] ?? "";
        $category = $row["category"] ?? "";

    }
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST["id"] ?? ""; 
    $bookname = $_POST["bookName"] ?? "";
    $authorName = $_POST["authorName"] ?? "";
    $isbn = $_POST["isbn"] ?? "";
    $quantity = $_POST["quantity"] ?? "";
    $category = $_POST["category"] ?? "";

    $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");

    $query = "UPDATE `bookrecords` SET `bookName` = '$bookname', `authorName` = '$authorName', `isbn` = '$isbn', `quantity` = '$quantity', `category` = '$category' WHERE `bookrecords`.`id` = $id;";
    

    if(mysqli_query($conn, $query))
    {
        echo "<h1 style='text-align: center;'>Successfully inserted</h1>";
        header("refresh: 1; url = index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="mid3">
    <form action="" method="post">
        <h4>Edit</h4>
        <input type="hidden" name="id" id="id" value="<?php echo $id?>">
        <label for="bookName">Book name:</label>
        <input type="text" placeholder="Enter book name" name="bookName" id="bookName" value="<?php echo $bookname?>" required><br><br>
        
        <label for="authorName">Author:</label>
        <input type="text" placeholder="Enter author name" name="authorName" id="authorName"value="<?php echo $authorName?>" required><br><br>
        
        <label for="isbn">ISBN:</label>
        <input type="text" placeholder="Enter ISBN" name="isbn" id="isbn"value="<?php echo $isbn?>" required><br><br>
        
        <label for="quantity">Quantity:</label>
        <input type="text" placeholder="Enter quantity" name="quantity" id="quantity" value="<?php echo $quantity?>" required><br><br>
        
        <label for="category">Category:</label>
        <input type="text" placeholder="Enter category" name="category" id="category" value="<?php echo $category?>" required><br><br>
        
        <input type="submit" name="submit" id="submit" value="Edit">
    </form>
</div>

<style>
    .mid3 {
        display: flex;
        justify-content: center; /* Center the form horizontally */
        align-items: center; /* Center the form vertically if container has a height */
        padding: 20px;
        background-color: #f4f4f4; /* Light background for the form section */
        border: 2px solid #ddd; /* Light gray border */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        max-width: 400px; /* Limit the form width */
        margin: 20px auto; /* Center the form with spacing */
    }

    form {
        width: 100%;
        font-family: Arial, sans-serif; /* Clean font */
        color: #333; /* Text color */
    }

    h4 {
        margin-bottom: 20px; /* Spacing below the heading */
        color: #4CAF50; /* Green heading */
        text-align: center; /* Center heading text */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%; /* Full-width inputs */
        padding: 10px; /* Inner spacing */
        margin-bottom: 15px; /* Space between inputs */
        border: 1px solid #ccc; /* Light gray border */
        border-radius: 5px; /* Rounded corners */
        box-sizing: border-box; /* Ensure padding doesn't overflow */
        font-size: 1em; /* Slightly larger font size */
    }

    input[type="submit"] {
        background-color: #4CAF50; /* Green button */
        color: white; /* White text */
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        width: 100%; /* Full-width button */
        transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    input[type="submit"]:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    .mid3 form br {
        display: none; /* Remove unnecessary breaks for cleaner spacing */
    }
</style>

</body>
</html>