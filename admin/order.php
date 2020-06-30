<?php
require("templates/header.inc.php");
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Orders </h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive table-stats order-table ov-h">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                               <th class="product-remove">Order ID</th>
                               <th class="product-thumbnail">Order Date</th>
                               <th class="product-name"><span class="nobr">Address</span></th>
                               <th class="product-price"><span class="nobr">Payment Type</span></th>
                               <th class="product-stock-stauts"><span class="nobr">Payment Status</span></th>
                              </tr>
                       </thead>
                       <tbody id="orders-list">
                       </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class = 'modal fade' id = 'orderdetailmodal' tabindex = '-1' role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>
  <div class = 'modal-dialog' role = 'document'>
    <div class = 'modal-content'>
      <div class = 'modal-header'>
        <button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>
          <span aria-hidden = 'true'>&times;
          </span>
        </button>
        <h5 class = 'modal-title' id = 'exampleModalLabel'>View Book Detail</h5>      
      </div>
      <div class = 'modal-body'>
         <div class="table-responsive table-stats">
                 <table class="table table-bordered">
                    <thead>
                       <tr>
                           <th class="product-remove">Book</th>
                           <th class="product-thumbnail">Title</th>
                           <th class="product-name"><span class="nobr">Qty</span></th>
                           <th class="product-price"><span class="nobr">Price</span></th>
                           <th class="product-stock-stauts"><span class="nobr">Total</span></th>
                          <th class="product-stock-stauts"><span class="nobr">Order Status</span></th>
                          <th class="product-stock-stauts">Action</th>
                        </tr>
                   </thead>
                   <tbody id="orderdetail-list">
                   </tbody>
                 </table>
              </div>
      </div>
      <div class = 'modal-footer'>
        <button type = 'button' class = 'btn btn-secondary' data-dismiss = 'modal'>Close</button>
      </div>
    </div>
  </div>
</div>
<?php
require("templates/footer.inc.php");
?>