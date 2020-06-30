<?php
require("templates/header.inc.php");
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Categories </h4>
                  <div class="float-right">
                  	   <a href="javascript:void(0)" id="add-category" data-toggle="modal" data-target="#category_modal" class="btn btn-primary btn-sm">Add Category</a>
                  </div>
                </div>
               <div class="card-body">
                  <div id="category-message">

                  </div>
                  <div class="table-responsive table-stats order-table ov-h">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="serial">#</th>
                              <th class="avatar">ID</th>
                              <th>Category</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="category_list">
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel modal-title-category">Add Category</h5>
      </div>
      <form method="POST" id="category-form">
         <div class="modal-body">
           <div class="form-group">
               <label for="category" class=" form-control-label">Category</label>
               <input type="text" id="category" name="category" data-name="Category" placeholder="Enter Category Name" class="form-control required">
               <span class="error-message"></span>
            </div>
            <input type="hidden"id="cid" name="id" value="">
             <div id="category-form-output"></div>
        </div>
         <div class="modal-footer">
            <input name="submit_data" id="category-btn" type="submit" value="Submit" class="btn btn-info">      
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
         </div>
      </form>
    </div>
  </div>
</div>
<?php
require("templates/footer.inc.php");
?>