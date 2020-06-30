<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("header.inc.php");
require("nav.inc.php");
if(isset($_GET['id']) && $_GET['id'] != '')
{
   $book_id=$_GET['id'];
}
?>
<div class="wait overlay">
  <div class="loader"></div>
</div>
<div class="content-wrapper">
  <!-- Page Content -->
  <div class="container">
    <div id="book-content">

    </div>   
  </div>
  <!-- /.container -->
</div>

<?php
require("footer.inc.php");
?>
