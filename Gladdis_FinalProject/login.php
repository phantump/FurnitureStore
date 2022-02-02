<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <style>
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
    $user = $_POST['login'];
    $pass = $_POST['pass'];
        $con= new mysqli($servername, $username, $password,$db) or die("<br> Cannot connect to DB:". $db. "\n");

        $sqlcookie = $con->prepare("SELECT UsID,Ulogin,pass 
                                    FROM users 
                                    WHERE Ulogin= ? AND pass = ? ");
        $sqlcookie -> bind_param("ss", $user, $pass);

        $sqlcookie -> execute();
        $resultcookie = $sqlcookie -> get_result();


    while ($row = $resultcookie ->fetch_assoc()){
        $Userlog = $row['Ulogin'];
        $passlog = $row['pass'];
        $ID = $row['UsID'];

        if($user == $Userlog & $pass == $passlog) {
            setcookie("Log", $ID, time()+3600);
            Echo "<h1><b>Login Success click <a href = 'user.php'>here to continue<b></a></h1>";
           
            
        }else {
            echo "<h1>login Failed Check your info: <a href ='Webpage.html'>Return to Login</a></h1>";
        }
        $sqlcookie -> close();
        mysqli_close($con);

    };
    ?>
</body>
</html>