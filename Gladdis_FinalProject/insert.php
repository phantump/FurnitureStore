<!DOCTYPE html>
<html>
<head>
        <title>Add Furniture</title>
        <style>
        table,th,td {
                border: 1px solid black;
                vertical-align: center;
                background-color: white;
            }

                html {
                    display: table;
                    margin: auto;
                    height: 20%;
                }

                body {
                    display: table-cell;
                    vertical-align: middle;
                    background-color: tan;
                }
                Button {
                    text-align: center;
                    vertical-align: middle;
                }

            </style>
    </head>
    <body>
        <?php


        $category = $_POST["category"];
        $price = $_POST["price"];
        $user = $_COOKIE["Log"];

        include ("dbconfig.php");
        $conn = new mysqli($servername, $username, $password,$db);

        $welcome = $_COOKIE["Log"];
        $sqlw = "SELECT Ulogin FROM users WHERE UsID = $welcome";
        $ResW = mysqli_query($conn,$sqlw);
        while ($Roww = $ResW ->fetch_assoc()) {
        echo "Welcome User :<b> " . $Roww["Ulogin"] . "</b>, Here is your items for sale<br>";
        }


        $sql = "INSERT INTO furniture (sellid, category, price) VALUES
        ((SELECT UsID from users WHERE  UsID=$user),'$category','$price')";
    
        if ($conn->query($sql) === TRUE) {
          echo "<br>New Record Successful";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn)

        ?>
    <hr><a href = "user.php">See updates here</a>
    </body>
</html>
