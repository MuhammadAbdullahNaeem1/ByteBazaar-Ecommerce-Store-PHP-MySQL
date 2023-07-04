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
   .rating {
    display: inline-block;
    font-size: 0;
    line-height: 0;
	border: none;
border-style: none;
  }

  .rating label {
    display: inline-block;
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
  }

  .rating label:before {
    content: '\2606';
  }

  .rating label.checked:before,
  .rating label:hover:before {
    content: '\2605';
    color: #ffc107;
  }

input[type="radio"] {
  display: none;
}
</style>
   
</head>

<body>
  
    <?php

    if (isset($_GET['odd'])) {
        include("include/connect.php");

        $oid = $_GET['odd'];

        $query = "select * from `order-details` where oid = $oid";
        $result = mysqli_query($con, $query);

        echo "<form method='post'> <table><thead>
    <tr>
        <th>Img</th>
        <th>Name</th>
        <th>Price</th>
        <th>Review</th>
        <th>Rating</th>
    </tr>
    </thead><tbody>";

    $row_number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      // ...
      include("include/connect.php");

        $pid = $row['pid'];
        $query = "select * from products where pid = $pid";

        $result2 = mysqli_query($con, $query);

        $row2 = mysqli_fetch_assoc($result2);

        $img = $row2['img'];
        $pname = $row2['pname'];
        $price = $row2['price'];
      echo "
        <tr>
          <td>$pname</td>
          <td><img src='product_images/$img' width='20px' height='20px' alt='Product 1'></td>
          <td>$price</td>
          <td><input type='text' name='$pid-review'></td>
          <td>
            <fieldset class='rating'>
              <input type='radio' id='rating1' name='rating' value='1'><label for='rating1'></label>
              <input type='radio' id='rating2' name='rating' value='2'><label for='rating2'></label>
              <input type='radio' id='rating3' name='rating' value='3'><label for='rating3'></label>
              <input type='radio' id='rating4' name='rating' value='4'><label for='rating4'></label>
              <input type='radio' id='rating5' name='ratingr' value='5'><label for='rating5'></label>
            </fieldset>
          </td>
        </tr>
      ";
      $row_number++;
    }
        echo"</tbody></table></form>";
    } 
    ?>

        <script src="script.js"></script>
</body>

</html>

<script>
  // Get all the rating fields on the page
  const ratingFields = document.querySelectorAll('.rating');

  // Loop through each rating field
  ratingFields.forEach(ratingField => {
    // Get all the stars in this rating field
    const stars = ratingField.querySelectorAll('input[type="radio"]');

    // Loop through each star
    stars.forEach(star => {
      // Listen for click events on this star
      star.addEventListener('click', function() {
        // Set the clicked star and all the stars before it to be checked and filled
        for (let i = 0; i < star.value; i++) {
          console.log('hello');
          stars[i].checked = true;
          stars[i].nextElementSibling.classList.add('checked');
        }

        // Set all the stars after the clicked star to be unchecked and empty
        for (let i = star.value; i < stars.length; i++) {
          stars[i].checked = false;
          console.log('hello');

          stars[i].nextElementSibling.classList.remove('checked');
        }
      });
    });
  });
</script>