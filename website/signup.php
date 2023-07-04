<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassowrd = $_POST['confirmPassword'];
    $cnic = $_POST['cnic'];
    $dob = $_POST['dob'];
    $contact = $_POST['phone'];
    $gen = $_POST['gender'];
    $email = $_POST['email'];

    $query = "select * from accounts where username = '$username' or cnic='$cnic' or phone='$contact' or email='$email'";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row['aid'])) {
        echo "<script> alert('Credentials already exists'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($password != $confirmpassowrd) {
        echo "<script> alert('Passwords do not match'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($password < 8) {
        echo "<script> alert('Passwords too short'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (strtotime($dob) > time()) {
        echo "<script> alert('invalid date'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if ($gen == "S") {
        echo "<script> alert('select gender'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (preg_match('/\D/', $cnic) || strlen($cnic) != 13) {
        echo "<script> alert('invalid cnic'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }
    if (preg_match('/\D/', $contact) || strlen($contact) != 11) {
        echo "<script> alert('invalid number'); setTimeout(function(){ window.location.href = 'signup.php'; }, 100); </script>";
        exit();
    }

    $query = "insert into `accounts` (afname, alname, phone, email,cnic, dob, username, gender,password) values ('$firstname', '$lastname', '$contact','$email', '$cnic', '$dob', '$username', '$gen','$password')";

    $result = mysqli_query($con, $query);



    if ($result) {
        echo "<script> alert('Successfully entered account'); setTimeout(function(){ window.location.href = 'login.php'; }, 100); </script>"; // exit();
    }

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

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt="" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">login</a></li>
                <li><a class="active" href="signup.php">SignUp</a></li>
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


    <form method="post" id="form">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="fn" name="firstName" type="text" placeholder="First Name *" required="required">
        <input class="input1" id="ln" name="lastName" type="text" placeholder="Last Name *" required="required">
        <input class="input1" id="user" name="username" type="text" placeholder="Username *" required="required">
        <input class="input1" id="email" name="email" type="text" placeholder="Email *" required="required">
        <input class="input1" id="pass" name="password" type="password" placeholder="Password *" required="required">
        <input class="input1" id="cpass" name="confirmPassword" type="password" placeholder="Confirm Password *"
            required="required">
        <input class="input1" id="cnic" name="cnic" type="number" placeholder="CNIC *" required="required">
        <input class="input1" id="dob" name="dob" type="date" placeholder="Date Of Birth " required="required">
        <input class="input1" id="contact" name="phone" type="number" placeholder="Contact *" required="required">
        <select class="select1" id="gen" name="gender" required="required">
            <option value="S">Select Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
        <button name="submit" type="submit" class="btn">Submit</button>

    </form>

    <div class="sign">
        <a href="login.php" class="signn">Already have an account?</a>
    </div>


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
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>