<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .error{
            width: 300px;
            height: 200px;
            background-color: lightblue;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <?php
        $errors = [];
        $check = false;
        $used = false;

        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $name = ucwords(strtolower($_POST["name"] ?? ""));
            $id = $_POST["id"] ??"";
            $email = $_POST["email"]??"";
            $book = $_POST["book"]??"";
            $borrowDate = $_POST["borrowDate"]??"";
            $returnDate = $_POST["returnDate"]??"";
            $token = $_POST["token"]??"";
            $fees = $_POST["fees"]??"";

            $bookCookie = str_replace(" ", "", $book);
            
            //name validation
            if (!preg_match("/^([A-Z][a-z]+)\s([A-Z][a-z]+)(\s[A-Z][a-z]+)?$/", $name)) {
                $errors[] = "Invalid name format.";
            }

            //id validation
            if (!preg_match("/^\d{2}-\d{5}-\d$/", $id)) {
                $errors[] = "Invalid ID format. Use 'XX-XXXXX-X'.";
            }

            // email validation
            if (!preg_match("/^\d{2}-\d{5}-\d@student\.aiub\.edu$/", $email)) {
                $errors[] = "Invalid email format. It should be in the format 'XX-XXXXX-X@student.aiub.edu'.";
            }

            if(!isset($_COOKIE[$bookCookie]))
            {
                setcookie($bookCookie, $name, time() + 20);
            }
            else if(isset($_COOKIE[$bookCookie]) && $_COOKIE[$bookCookie] == $name)
            {

                $errors[] = "<h5 style='color: black;'>This book is already borrowed by </h5> <h2 style='color: red;'>$name</h2> ";
            }

            // borrowing and return dates validation
            $borrowDateObj = new DateTime($borrowDate);
            $returnDateObj = new DateTime($returnDate);
            $dateDiff = $borrowDateObj->diff($returnDateObj);
            if ($borrowDateObj >= $returnDateObj) {
                $errors[] = "Return date must be after the borrow date.";
            }
            else if($dateDiff->days >10)
            {
                if(file_exists("token.json"))
                {
                    $jsonToken = json_decode(file_get_contents("token.json"), true);
                    $numberOfTokens = sizeof($jsonToken[0]["token"]);

                    for($i = 0; $i<$numberOfTokens ; $i++)
                    {
                        if($jsonToken[0]["token"][$i] == $token)
                        {
                            $check = true;
                        }
                    }

                    if(file_exists("data.json"))
                    {
                        $usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                        $used = in_array($token,$usedtoken);
                    }


                    if(!$check)
                    {
                        $errors[] = "Return date must be within 10 days.";
                    }
                    else if($used)
                    {
                        $errors[] = "You can use a token in once.";
                    }
                    else if(empty($errors))
                    {
                        if(file_exists("data.json"))
                        {
                            $usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                            $usedtoken[] = $token;
                            $json = json_encode($usedtoken);
                            
                            file_put_contents("data.json", $json);

                        }

                        if(!file_exists("data.json"))
                        {
                            // $data = [
                            //   "token" => [$token]
                            // ];

                            $json = json_encode($token);
                            
                            file_put_contents("data.json", $json);
                        }
                    }
                }
                
            }
            
            
            if(empty($errors))
            {
                echo "<div class='receipt'>";
                echo "<h2>Borrow Book Receipt</h2>";
                echo "<p style='color:green;'>Form submitted successfully!</p>";
                echo "<p>Student Name: ".$name."</p>";
                echo "<p>Student ID: ".$id."</p>";
                echo "<p>Email: ".$email."</p>";
                echo "<p>Book Title: ".$book."</p>";
                echo "<p>Borrow Date: ".$borrowDate."</p>";
                echo "<p>Return Date: ".$returnDate."</p>";
                echo "<p>Token: ".$token."</p>";
                echo "<p>Fees: ".$fees."</p>";
                echo "</div>";

                    // $conn = mysqli_connect('localhost', 'root','', "bookBorrowing");
                
                    // $query1 = "select * from bookrecords where bookName=$book";

                    // $result5 = mysqli_query($conn, $query1);
                    // $row = mysqli_fetch_array($result5);

                    // $quantity = ($row["quantity"] ?? "") - 1;
                    
                    // $query2 = "UPDATE `bookrecords` SET `quantity` = '$quantity' WHERE bookName=$book";
                    // mysqli_query($conn, $query2);
    
            }

            if(!empty($errors))
            {
                echo "<div class='error'>";
                foreach ($errors as $error) 
                {
                    echo "<p style='color:red;'>$error</p>";
                }
                echo "<button onclick='history.back()'>Go Back</button>";
                echo "</div>";
                    
            }

        }
        

    ?>
</body>
</html>