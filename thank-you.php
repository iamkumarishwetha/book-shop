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
    <div class="shopping-cart-wrapper text-center">
      <div class="row mt-4 mb-4">
        <div class="col-12">
          <h2>Thank you! Your order has been placed successfully</h2>
          <h4>Delivery process time, minimum of three(3) days and maximum of five(5) working days.</h4>
          <h3 class="mt-5">Your order details...<a href="/ebook/my-order">Visit here</a></h3>
        </div>
      </div>
    <!-- /.row -->
    </div>
  </div>
</div>
  <!-- /.container -->
<?php
require("footer.inc.php");
?>