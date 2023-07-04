<?php
session_start();

if ($_SESSION['aid'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $aid = $_SESSION['aid'];
    $pid = $_GET['re'];
    $query = "DELETE FROM wishlist WHERE aid = $aid and pid = $pid";

    $result = mysqli_query($con, $query);
    header("Location: wishlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ByteBazaar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css" />
    <script>
window.addEventListener("beforeunload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php

                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>login</a></li>
            <li><a href='signup.php'>SignUp</a></li>
            ";
                } else {
                    echo "   <li><a href='profile.php'>profile</a></li>
          ";
                }
                ?>
                <li><a href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a class="active" href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>#GamingTillTheEnd</h2>

        <p>Providing Premium Gaming Experience</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM wishlist JOIN products ON wishlist.pid = products.pid WHERE aid = $aid";

                $result = mysqli_query($con, $query);



                while ($row = mysqli_fetch_assoc($result)) {
                    $pid = $row['pid'];
                    $pname = $row['pname'];
                    $desc = $row['description'];
                    $qty = $row['qtyavail'];
                    $price = $row['price'];
                    $cat = $row['category'];
                    $img = $row['img'];
                    $brand = $row['brand'];
                    echo "

        <tr>
          <td>
            <a href='wishlist.php?re=$pid'><i class='far fa-times-circle'></i></a>
          </td>
          <td><img src='product_images/$img' alt='' /></td>
          <td>$pname</td>
          <td class='pr'>$$price</td>
        </tr>
        ";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" />
            <h4>Contact</h4>
            <p>
                <strong>Address: </strong> Street 2, Johar Town Block A,Lahore

            </p>
            <p>
                <strong>Phone: </strong> +92324953752
            </p>
            <p>
                <strong>Hours: </strong> 9am-5pm
            </p>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.php">My Wishlist</a>
        </div>
        <div class="col install">
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" />
        </div>
        <div class="copyright">
            <p>2021. byteBazaar. HTML CSS </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>