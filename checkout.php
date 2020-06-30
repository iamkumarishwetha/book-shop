<?php
session_start();
if(!isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] == '')
{
  header('location:login.php');
}
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
  <div class="shopping-cart-wrapper">
    <div class="row mt-4 mb-4">
      <div class="col-md-8 offset-md-2">
          <div class="row">
            <div class="col-12">
              <form method="POST" action="action.php" onsubmit="return submitCkecoutForm();">
                <div class="card bg-secondary text-white mb-4">
                  <div class="card-body bg-padding">Address Information</div>
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Street address</label>
                    <textarea class="form-control" id="streetaddress" name="street-address" placeholder="Enter your Street address"></textarea>
                    <small  class="form-text"></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">City/State</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your City/State">
                    <small  class="form-text"></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Post Code/zip</label>
                    <input type="text" class="form-control" id="post-code" name="post-code" placeholder="Enter your Post Code/zip">
                    <small  class="form-text"></small>
                  </div>
                  <div class="card bg-secondary text-white  mb-4">
                    <div class="card-body bg-padding">Payment Information</div>
                  </div>
                  <div class="input-radio-wrapper">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input optpayment" value="COD"  name="optpayment">COD
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input optpayment" value="Payu" name="optpayment">Payu
                      </label>
                    </div>
                     <small  class="form-text"></small>
                  </div>
                  <div class="form-group mt-4">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit" name="submit_checkout">
                    <small  class="form-text text-danger mt-2" id="signup_msg"></small>    
                  </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
 </div>
<?php
require("footer.inc.php");
?>