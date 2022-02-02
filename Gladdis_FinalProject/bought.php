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
    </head>
<body>
    <?php
       include("dbconfig.php");
       $con = new mysqli($servername, $username, $password,$db);
       $sql2 = "SELECT UsID,sellid, Ulogin, email, phone, category, price, fid
       FROM users inner join furniture
       ON users.UsID = furniture.sellid";
    
    $bought = $_POST["buy"];
    $sql = "DELETE FROM furniture
    WHERE fid = $bought";
    $result = mysqli_query($con,$sql);
       if ($con->query($sql) === TRUE) {
           echo "Record updated successfully";
         } else {
          echo "Error updating record: " . $con->error;
        };
    
       
       $result2 = mysqli_query($con,$sql2);
       if ( $num = mysqli_num_rows($result2) > 0) {
           echo" <table><tr>
                       <th>User Name</th>
                       <th>email</th>
                       <th>Phone</th>
                       <th>Category</th>
                       <th>Price</th></tr>";
   
           while ($row = $result2->fetch_assoc()) {
               echo "<tr> <td>" .$row["Ulogin"]. "</td>";
               echo "    <td>" .$row["email"] ."</td>";
               echo "    <td>" .$row["phone"] ."</td>";
               echo "    <td>" .$row["category"] ."</td>";
               echo "    <td>" .$row["price"] ."</td>";
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