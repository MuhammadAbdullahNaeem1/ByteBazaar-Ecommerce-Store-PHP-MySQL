<?php
session_start();

if ($_SESSION['aid'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $aid = $_SESSION['aid'];
    $pid = $_GET['re'];
    $query = "DELETE FROM CART WHERE aid = $aid and pid = $pid";

    $result = mysqli_query($con, $query);
    header("Location: cart.php");
    exit();
}

if (isset($_POST['check'])) {
    include("include/connect.php");

    $aid = $_SESSION['aid'];

    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

    $result = mysqli_query($con, $query);

    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result2);

    if (empty($row2['pid'])) {
        header("Location: shop.php");
        exit();
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['pid'];
        $pname = $row['pname'];
        $desc = $row['description'];
        $qty = $row['qtyavail'];
        $price = $row['price'];
        $cat = $row['category'];
        $img = $row['img'];
        $brand = $row['brand'];
        $cqty = $row['cqty'];
        $a = $price * $cqty;

        $newqty = $_POST["$pid-qt"];

        $query = "UPDATE CART SET cqty = $newqty where aid = $aid and pid = $pid";

        mysqli_query($con, $query);


    }
    header("Location: checkout.php");
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


</head>

<body onload="totala()">
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
        <h2>#GameTillTheEnd</h2>

        <p>Providing premium gaming experience</p>
    </section>


    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>

                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

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
                    $cqty = $row['cqty'];
                    $a = $price * $cqty;
                    echo "

            <tr>
              <td>
                <a href='cart.php?re=$pid'><i class='far fa-times-circle'></i></a>
              </td>
              <td><img src='product_images/$img' alt='' /></td>
              <td>$pname</td>
              <td class='pr'>$$price</td>
              <td><input type='number' class = 'aqt' value='$cqty' min = '1' max = '$qty' onchange='subprice()' /></td>
              <td class = 'atd'>$$a</td>
            </tr>
            ";
                }
                ?>

            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">

        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td id='tot1' onload="totala()">$</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id='tot' onload="totala()"><strong>$</strong></td>
                </tr>
            </table>

            <form method="post">
                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

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
                    $cqty = $row['cqty'];
                    $a = $price * $cqty;
                    echo "

              <input style='display: none;' name='$pid-p' class='inp' type = 'number' value = '$pid'/>
              <input style='display: none;' name='$pid-qt' class='inq' type = 'number' value = '$cqty'/>
              ";
                }
                ?>
                <button class="normal" name="check">Proceed to checkout</button>
            </form>
            </a>
        </div>
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

<script>
function subprice() {
    var qty = document.getElementsByClassName("aqt");
    var sub = document.getElementsByClassName("atd");
    var pri = document.getElementsByClassName("pr");
    var upd = document.getElementsByClassName("inq");

    for (var i = 0; i < qty.length; i++) {
        var quantity = parseInt(qty[i].value);
        var price = parseFloat(pri[i].innerText.replace('$', ''));
        sub[i].innerHTML = `$${quantity * price}`;
        upd[i].value = parseInt(qty[i].value);
    }

    totala();
}

function totala() {
    var pri = document.getElementsByClassName("atd");
    let yes = 0;
    for (var i = 0; i < pri.length; i++) {
        yes = yes + parseFloat(pri[i].innerText.replace('$', ''));
    }


    document.getElementById('tot').innerHTML = '$' + yes;
    document.getElementById('tot1').innerHTML = '$' + yes;
}
</script>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>