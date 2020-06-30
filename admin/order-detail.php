<?php
require("templates/header.inc.php");
$order_id=escapeString($con,$_GET['id']);
IF(isset($_POST['submit']))
{
  $update_order_status=escapeString($con,$_POST['update_order_status']);
  mysqli_query($con,"UPDATE order_tbl SET order_status='$update_order_status' WHERE id='$order_id'");
}
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Order Details</h4>
                </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                    <table class="table">
                      <thead>
                          <tr>
                              <th class="product-remove">Product Name</th>
                              <th class="product-thumbnail">Product Image</th>
                              <th class="product-name"><span class="nobr">Qty</span></th>
                              <th class="product-price"><span class="nobr">Price</span></th>
                              <th class="product-stock-stauts"><span class="nobr">Total Price</span></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $sql="SELECT order_detail.*,product.name,product.image,order_tbl.address,order_tbl.city,order_tbl.pincode,order_tbl.order_status from order_detail,product,order_tbl WHERE order_detail.order_id='$order_id' AND order_detail.product_id=product.id GROUP BY order_detail.id";
                          $res=mysqli_query($con,$sql);
                          $total_price=0;
                          while($row = mysqli_fetch_assoc($res)){
                              $total_price = $total_price + ( $row['qty'] * $row['price']);
                          ?>
                          <tr>
                              <td class="product-add-to-cart"><?php echo $row['name']; ?></td>
                              <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>" alt="full-image"></td>
                              <td><?php echo $row['qty']; ?></td>
                              <td><?php echo $row['price']; ?></td>
                              <td><?php echo $row['qty'] * $row['price']; ?></td>                         
                          </tr>
                          <?php 
                          } 
                          ?>
                          <tr>
                            <th colspan="3"></th>
                            <th>Total Price</th>
                            <th><?php echo $total_price; ?></th>
                        </tr>
                      </tbody>
                    </table>
                    <div id="address-details" class="p-3">
                      <?php 
                       $query="SELECT order_tbl.address,order_tbl.city,order_tbl.pincode,order_status.name FROM order_tbl,order_status WHERE order_tbl.order_status=order_status.id AND order_tbl.id='$order_id'";
                      $order_info=mysqli_fetch_assoc(mysqli_query($con,$query));
                      ?>
                      <strong> Address</strong>
                      <?php echo $order_info['address'] . ", " . $order_info['city'] .", " . $order_info['pincode']; ?><br><br>
                       <strong>Order Status</strong>
                      <?php 
                       echo $order_info['name'];
                      ?>
                      <div class="mt-2">
                         <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <select class="form-control" name="update_order_status" required>
                                  <option value="">Select Status</option>
                                  <?php
                                    $query_status=mysqli_query($con,"SELECT * FROM order_status");
                                    while($row_status = mysqli_fetch_assoc($query_status))
                                    {
                                         echo "<option value='".$row_status['id']."'>".$row_status['name']."</option>";
                                    }
                                  ?>
                                </select>
                             </div>
                             <div class="form-group">
                                <input type="submit" value="submit" name="submit" class="btn btn-primary" >
                             </div>
                          </form>
                      </div>
                    </div>
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