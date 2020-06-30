<?php
require("templates/header.inc.php");
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Contact Us</h4>
                </div>
               <div class="card-body">
                   <div id="contact-message">
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
                              <th>Query</th> 
                              <th>Date</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody id="contactus-list">
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