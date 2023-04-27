<?php
require('../config.php');
include('adminHeader.php');
?>

<br>
<div id="page-wrapper">
    <h1><b>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></b> </h1>
</div>

<?php
include('adminFooter.php');
?>

<div class="container-fluid px-4">
    <h4 class='mt-4'>Managers</h4>
<div class = "row">
    <div class = "col-md-12">
        <?php include('message.php');?>
        <div class = "card-header">
            <h4> Registered Manager 
                <a href="add_manager.php" class = "btn btn-primary float-end"> ADD MANAGER </a>
            </h4>
