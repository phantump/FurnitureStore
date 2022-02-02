<!DOCTYPE html>
<html>
<head>
        <title>Login Page</title>
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
            <h1>Welcome to the Gladdis Furniture Store</h1>
    </head>
   <body> 
    <div id="scroll-image">
            <img src= "images/bed.jpg" height = 200px Length = 200px class="test" />
            <img src= "images/chair.jpg" height = 200px Length = 200px class="test" />
            <img src= "images/desk.jpg" height = 200px length = 200px class="test" />
        </div>

    <script>
    startImageTransition();
 
    function startImageTransition() {
 
        // images stores list of all images of
        // class test. This is the list of images
        // that we are going to iterate
        var images = document.getElementsByClassName("test");
 
        // Set opacity of all images to 1
        for (var i = 0; i < images.length; ++i) {
            images[i].style.opacity = 1;
        }
 
        // Top stores the z-index of top most image
        var top = 1;
        var cur = images.length - 1;
 
        setInterval(changeImage, 3000);
 
    
        async function changeImage() {

            var nextImage = (1 + cur) % images.length;

            images[cur].style.zIndex = top + 1;
            images[nextImage].style.zIndex = top;
            await transition();
            images[cur].style.zIndex = top;
            images[nextImage].style.zIndex = top + 1;
            top = top + 1;
 
            images[cur].style.opacity = 1;
 
            cur = nextImage;
        }
 
        function transition() {
            return new Promise(function (resolve, reject) {
                var del = 0.01;
 
                var id = setInterval(changeOpacity, 10);
 
                function changeOpacity() {
                    images[cur].style.opacity -= del;
                    if (images[cur].style.opacity <= 0) {
                        clearInterval(id);
                        resolve();
                    }
                }
            })
        }
    }
</script>
   <?php
    include("dbconfig.php");

    
        $id = $_COOKIE['Log'];
        $con2=@mysqli_connect($servername, $username, $password,$db) or die("<br> Cannot connect to DB:". $dbname. "\n");
        $sql ="SELECT * FROM users WHERE UsID = '$id' ";
        $results = mysqli_query($con2,$sql);
        if (mysqli_num_rows($results)==0) {
            echo "Login $user does not exist" and die;

    }
    $id = $_COOKIE['Log'];
    $sql2 = "SELECT UsID, Ulogin, email, phone, category, price 
    FROM users inner join furniture
    ON Users.UsID = furniture.sellid
    Where UsID = '$id'
     ";

    $result2 = mysqli_query($con2,$sql2);
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
            echo "    <td>" .$row["price"] ."</td></tr>";
        }
        echo "</table>";}
    else {
        echo "0 results found";
    };
    mysqli_close($con2);

    echo "<form action = insert.html method = post>
    <button> Add Item to sell </button></form>";
    echo "<form action = search2.html method = post>
    <button>view Items</button></form>";  
    echo "<form action = purchase.php method = post>
    <button>Buy Items</button></form>";



    ?>
</body>
</html>