<?php
session_start();
if(!isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] != '')
{
  header('location:login.php');
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("header.inc.php");
require("nav.inc.php")
?>
<div class="wait overlay">
  <div class="loader"></div>
</div>
 <!-- Page Content -->
 <div class="content-wrapper">
   <div class="container">
    <div class="shopping-cart-wrapper mt-2">
      <div id="order-list">
      </div>
    <!-- /.row -->
    </div>
  </div>
 </div>
  <!-- /.container -->
<?php
require("footer.inc.php");
?>