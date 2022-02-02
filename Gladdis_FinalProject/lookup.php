<!DOCTYPE html>
<html>
    <head>
        <title>Search for Item</title>
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
    include("dbconfig.php");
    $con= mysqli_connect($servername, $username, $password,$db) or die("<br> Cannot connect to DB:". $dbname. "\n");

    // $welcome = $_COOKIE["Log"];
    // $sqlw = "SELECT Ulogin FROM users WHERE UsID = $welcome";
    // $ResW = mysqli_query($con,$sqlw);
    // while ($Roww = $ResW ->fetch_assoc()) {
    // echo "Welcome User :<b> " . $Roww["Ulogin"]."</b><br>";

    //};
    
        $sql2 = "SELECT Ulogin, email, phone, category, price 
        FROM users inner join furniture
        ON Users.UsID = furniture.sellid
        WHERE category = ?";

    $stmt = $con->prepare($sql2);
    $stmt->bind_param("s",$_GET['q']);
    $stmt -> execute();
  $result = $stmt ->get_result();
    if ( $num = mysqli_num_rows($result) > 0) {
        echo" <table><tr>
                    <th>User Name</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th>Price</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr> <td>" .$row["Ulogin"]. "</td>";
            echo "    <td>" .$row["email"] ."</td>";
            echo "    <td>" .$row["phone"] ."</td>";
            echo "    <td>" .$row["category"] ."</td>";
            echo "    <td>" .$row["price"] ."</td></tr>";
        }
        echo "</table>";}
    
    else {
        echo "0 results found";
            
};
    $stmt->close();
            mysqli_close($con);
    ?>
 <hr><a href = "user.php">Return to the Main page</a>
    </body>
