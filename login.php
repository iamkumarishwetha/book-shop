<?php
session_start();
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
      <div class="row mt-4 mb-4">
        <div class="col-lg-6">
           <div class="login_form">
                 
          <div class="row mb-2">
              <div class="col-12">
                  <h2>Login</h2>
              </div>
          </div>
           <div class="row">
              <div class="col-12">
                      <form method="POST" id="user-login">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="text" class="form-control" id="login-email" name="login-email" placeholder="Enter your email">
                          <small  class="form-text"></small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Enter your password">
                          <small  class="form-text"></small>
                        </div>
                         <input type="submit" class="btn btn-primary" value="Login" name="user_login">
                        <small  class="form-text text-danger mt-2" id="login_msg"></small>
                    </form>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-lg-6">
          <div class="register_form">    
              <div class="row mb-2">
                  <div class="col-12">
                      <h2>New Account</h2>
                  </div>
              </div>
              <div class="row">
                     <div class="col-12">
                          <form method="Post" id="user-register">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Full Name</label>
                              <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Enter your full name">
                              <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="text" class="form-control" id="register-email" name="register-email" placeholder="Enter your email">
                              <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Enter your password">
                              <small class="form-text"></small>
                            </div>
                             <div class="form-group">
                              <label for="exampleInputPassword1">Confirm Password</label>
                              <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Re-Enter your password">
                              <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Mobile No</label>
                              <input type="text" class="form-control" id="mobile-no" name="mobile-no" placeholder="Enter your mobile no">
                              <small class="form-text"></small>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Register" name="user_register">
                            <small  class="form-text text-danger mt-2" id="signup_msg"></small>
                          </form>
                        </div>
                     </div>
            </div>
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