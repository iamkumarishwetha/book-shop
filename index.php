<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("header.inc.php");
require("nav.inc.php");
?>
<div class="wait overlay">
  <div class="loader"></div>
</div>
 <!-- Page Content -->
 <div class="content-wrapper">
  <div class="container">   
    <div class="row mt-3 mb-4">
     
      <div class="col-lg-3 mb-4">

        <h1 class="mb-4">Categories</h1>
        <div class="list-group" id="category-list">
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9 mb-4">
        <div class="row" id="book-list">
         
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
</div>
  <!-- /.container -->
<?php
require("footer.inc.php");
?>