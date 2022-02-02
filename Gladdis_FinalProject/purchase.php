<!doctype html>
<html>
    <head>
        <title>Purchase</title>
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
<body>
    <?php
   
       include("dbconfig.php");
       $con = new mysqli($servername, $username, $password,$db);
       $sql2 = "SELECT Ulogin, email, phone, category, price,fid
       FROM users inner join furniture
       ON Users.UsID = furniture.sellid";

        $welcome = $_COOKIE["Log"];
        $sqlw = "SELECT Ulogin FROM users WHERE UsID = $welcome";
        $ResW = mysqli_query($con,$sqlw);
        while ($Roww = $ResW ->fetch_assoc()) {
        echo "Welcome User :<b> " . $Roww["Ulogin"] . "</b>, Please select an item to buy";
        }


       $result2 = mysqli_query($con,$sql2);
       if ( $num = mysqli_num_rows($result2) > 0) {
           echo" <table><tr>
                       <th>User Name</th>
                       <th>email</th>
                       <th>Phone</th>
                       <th>Category</th>
                       <th>Price</th>
                       <th>Select Item to buy</th></tr>";
   
           while ($row = $result2->fetch_assoc()) {
               echo "<tr> <td>" .$row["Ulogin"]. "</td>";
               echo "    <td>" .$row["email"] ."</td>";
               echo "    <td>" .$row["phone"] ."</td>";
               echo "    <td>" .$row["category"] ."</td>";
               echo "    <td>" .$row["price"] ."</td>";
               echo "    <td><form action ='bought.php' method = 'post'> 
                        <input type='hidden' name='buy' value='".$row["fid"]."'>
                        <input type = 'submit'></form></td></tr>";
           }
           echo "</table>";}
       else {
           echo "0 results found";
       };
 
       
         mysqli_close($con);
           ?>
       <hr><a href = "user.php">Return to mainpage here</a>
       
</body>
</html>