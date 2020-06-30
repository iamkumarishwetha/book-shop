<?php
require("templates/header.inc.php");
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Users </h4>
                </div>
               <div class="card-body">
                  <div id="user-message">

                  </div>
                  <div class="table-responsive table-stats order-table ov-h">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th class="avatar">ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Date</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody id="users-list">
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
require("templates/footer.inc.php");
?>