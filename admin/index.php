<?php
require("templates/header.inc.php");
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Dashboard</h4>
                </div>
            </div>
         </div>
      </div>
      <div class="row">

        <div class="col-sm-3">
            <a href="categories.php">
               <div class="card text-white bg-primary">
                  <div class="card-header"><h3>Categories</h3></div>
                  <div class="card-body d-flex justify-content-between align-items-center">
                     <h5>Total Categories</h5>
                     <h5 id="count-category"></h5>
                  </div>
               </div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="book.php">
               <div class="card text-white bg-secondary">
                  <div class="card-header"><h3>Books</h3></div>
                   <div class="card-body d-flex justify-content-between align-items-center">
                     <h5>Total Books</h5>
                     <h5 id="count-book"></h5>
                  </div>
               </div>
            </a>
        </div>
         <div class="col-sm-3">
            <a href="users.php">
               <div class="card text-white bg-info">
                  <div class="card-header"><h3>Users</h3></div>
                  <div class="card-body d-flex justify-content-between align-items-center">
                     <h5>Total Users</h5>
                     <h5 id="count-user"></h5>
                  </div>
               </div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="order.php">
               <div class="card text-white bg-dark">
                  <div class="card-header"><h3>Orders</h3></div>
                  <div class="card-body d-flex justify-content-between align-items-center">
                     <h5>Total Orders</h5>
                     <h5 id="count-order" ></h5>
                  </div>
               </div>
            </a>
        </div>
      </div>
   </div>
</div>
<?php
require("templates/footer.inc.php");
?>