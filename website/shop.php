<?php
session_start();

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

    <style>
    .search-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        background: #e3e6f3;
        padding: 10px;
    }

    #category-filter {
        padding: 6px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
    }

    #search {
        padding: 6px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
    }

    #search-btn {
        outline: none;
        border: none;
        padding: 10px 30px;
        background-color: navy;
        color: white;
        border-radius: 1rem;
        cursor: pointer;
    }
    </style>

 
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
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
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header">
        <h2>Premium Gaming</h2>

        <p>Save more with coupons & up to 70% off!</p>
    </section>

    <div class="search-container">
        <form id="search-form" method="post">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
            <label for="category-filter">Category:</label>
            <select id="category-filter" name="cat">
                <option value="all">All</option>
                <option value="keyboard">Keyboard</option>
                <option value="motherboard">Motherboard</option>
                <option value="mouse">Mouse</option>
                <option value="cpu">CPU</option>
                <option value="gpu">GPU</option>
                <option value="ram">RAM</option>
            </select>
            <button type="submit" id="search-btn" name="search1">Search</button>
        </form>
    </div>

    <?php
    include("include/connect.php");
    if (isset($_POST['search1'])) {
        $search = $_POST['search'];
        $category = $_POST['cat'];
        $query = "";
        if (!empty($search))
            $query = "select* from `products` where ((pname like '%$search%') or (brand like '%$search%') or (description like '%$search%'))";
        else
            $query = "select * from `products`";

        if ($category != "all") {
            if (empty($search)) {
                $query = $query . "where category = '$category'";
            } else {
                $query = $query . "and category = '$category'";
            }
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $pname = $row['pname'];
            if (strlen($pname) > 35) {
                $pname = substr($pname, 0, 35) . '...';
            }
            $desc = $row['description'];
            $qty = $row['qtyavail'];
            $price = $row['price'];
            $cat = $row['category'];
            $img = $row['img'];
            $brand = $row['brand'];

           
                    $query2 = "SELECT pid, AVG(rating) AS average_rating FROM reviews where pid = $pid GROUP BY pid ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);
            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>$$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }
    } else {
        include("include/connect.php");

        $select = "Select* from products where qtyavail > 0 order by rand()";
        $result = mysqli_query($con, $select);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";


        }

        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $pname = $row['pname'];
            if (strlen($pname) > 35) {
                $pname = substr($pname, 0, 35) . '...';
            }
            $desc = $row['description'];
            $qty = $row['qtyavail'];
            $price = $row['price'];
            $cat = $row['category'];
            $img = $row['img'];
            $brand = $row['brand'];

            $query2 = "SELECT pid, AVG(rating) AS average_rating FROM reviews where pid = $pid GROUP BY pid ";

            $result2 = mysqli_query($con, $query2);

            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                $stars = $row2['average_rating'];
            } else {
                $stars = 0;
            }
            $stars = round($stars, 0);

            $empty = 5 - $stars;

            echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width = '235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
            for ($i = 1; $i <= $stars; $i++) {
                echo "<i class='fas fa-star'></i>";

            }
            for ($i = 1; $i <= $empty; $i++) {
                echo "<i class='far fa-star'></i>";

            }
            echo "</div>
                        <h4>$$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>
                 ";
        }

        if ($result) {

            echo "</section>
                    </div>";
        }

    }
    ?>


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
    function topage(pid) {
        window.location.href = `sproduct.php?pid=${pid}`;
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