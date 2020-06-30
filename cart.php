<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("header.inc.php");
require("nav1.inc.php")
?>
<div class="wait overlay">
  <div class="loader"></div>
</div>
 <!-- Page Content -->
 <div class="content-wrapper">
   <div class="container">
    <div class="shopping-cart-wrapper mt-2">
      <div class="row">
        <div class="col-12" id="cart_msg">
          <!--Cart Message--> 
        </div>
      <div class="col-md-2"></div>
    </div>
      <div id="cart-list">
      </div>
    <!-- /.row -->
    </div>
  </div>
 </div>
 
  <!-- /.container -->
<?php
require("footer.inc.php");
?>