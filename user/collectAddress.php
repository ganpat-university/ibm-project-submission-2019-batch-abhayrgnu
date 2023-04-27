<?php
require('../config.php');
include('userHeader.php');
?>

<br>
<div id="page-wrapper">
<form action="collectAddress_post.php" method="POST">
  <label for="name">Address Name:</label>
  <input type="text" id="name" name="name" required><br>

  <label for="phone">Phone:</label>
  <input type="text" id="phone" name="phone" required><br>

  <label for="addrs">Address:</label>
  <input type="text" id="addrs" name="addrs" required><br>

  <label for="pincode">Pincode:</label>
  <input type="text" id="pincode" name="pincode" required><br>

  <label for="state">State:</label>
  <input type="text" id="state" name="state" required><br>

  <label for="country">Country:</label>
  <input type="text" id="country" name="country" required><br>


  <input type="submit" value="Submit">
</form></div>

<?php
include('userFooter.php');
?>