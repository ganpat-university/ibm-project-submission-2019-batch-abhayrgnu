<?php
require('../config.php');
include('managerHeader.php');
?>

<br>
<div id="page-wrapper">
    <h1><b>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></b> </h1>
</div>

<?php
include('managerFooter.php');
?>