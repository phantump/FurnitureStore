<!DOCTYPE html>
<html>
<head>
        <title>Welcome User</title>
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
        $User = $_POST["user"];
        $pass = $_POST["pass"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];




        $regex = "^(\(?\d{3}\)?)?[- .]?(\d{3})[- .]?(\d{4})^";

        $RegPhone = preg_replace($regex,"(\\1) \\2-\\3", $phone); 
    


        include ("dbconfig.php");
        $conn = new mysqli($servername, $username, $password,$db);
    
        $sql = "INSERT INTO users (UsID, Ulogin, pass, email,phone) VALUES
        (DEFAULT, '$User','$pass','$email','$RegPhone')";
    
        if ($conn->query($sql) === TRUE) {
          echo "New Record Successful";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn)

        ?>
    <h1>Thank you for Signing up</h1>
    <hr><a href = "Webpage.html">Click here to return to Login</a>
    </body>
</html>
