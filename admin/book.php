<?php
require( 'templates/header.inc.php' );
?>
<div class = 'content pb-0'>
	<div class = 'orders'>
		<div class = 'row'>
			<div class = 'col-xl-12'>
				<div class = 'card'>
					<div class = 'card-body'>
						<h4 class = 'box-title'>Books</h4>
						<div class = 'float-right'>
							<a href = '#' data-toggle = 'modal' data-target = '#book_modal' id="add-book" class = 'btn btn-primary btn-sm'>Add Book</a>
						</div>
					</div>
					<div class = 'card-body'>
						 <div id="book-message"></div>
						<div class = 'table-responsive table-stats order-table ov-h'>
							<table class = 'table table-bordered'>
								<thead>
									<tr>
										<th class = 'serial'>#</th>
										<th class = 'avatar'>ID</th>
										<th>Category</th>
										<th>Name</th>
										<th>Image</th>
										<th>Price</th>
										<th>Qty</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id = 'book-list'>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class = 'modal fade' id = 'book_modal' tabindex = '-1' role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>
	<div class = 'modal-dialog' role = 'document'>
		<div class = 'modal-content'>
			<div class = 'modal-header'>
				<button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>
					<span aria-hidden = 'true'>&times;
					</span>
				</button>
				<h5 class = 'modal-title book-modal-title' id = 'exampleModalLabel'></h5>			
			</div>
			<form method = 'POST' id = 'book-form' enctype="multipart/form-data">
				<div class = 'modal-body'>
					<div id="book-form-output"></div>
					<input type="hidden"id="bid" name="id" value="">
					<div class = 'form-group'>
						<label for = 'category_id' class = 'form-control-label'>Category</label>
						<select class = 'form-control category_list required' data-name="Category" name = 'category_id' id = 'category_id'>
						</select>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'name' class = ' form-control-label'>Book Name</label>
						<input type = 'text' id = 'name' name = 'name' data-name="Name" placeholder = 'Enter Book Name' class = 'form-control required'>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'price' class = ' form-control-label'>Price</label>
						<input type = 'text' id = 'price' name = 'price' data-name="Price" placeholder = 'Enter Book Price' class = 'form-control required' >
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'qty' class = ' form-control-label'>Qty</label>
						<input type = 'text' id = 'qty' name = 'qty' data-name="Qty" placeholder = 'Enter Book Qty' class = 'form-control required'>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'image' class = ' form-control-label'>Image <small>(format: jpg, jpeg, png)</small></label>
						<input type = 'file' id = 'image' name = 'image' data-name="Image" class = 'form-control  required' >
						<div class="img"></div>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'short_desc' class = ' form-control-label'>Short Description</label>
						<textarea id = 'short_desc' name = 'short_desc' data-name="Short Description" placeholder = 'Enter Book Short Description' class = 'form-control required'></textarea>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'desc' class = ' form-control-label'>Description</label>
						<textarea id = 'desc' name = 'desc' data-name="Description" placeholder = 'Enter Book Description' class = 'form-control required'></textarea>
						<span class = 'error-message'></span>
					</div>
					<div class = 'form-group'>
						<label for = 'meta_keyword' class = ' form-control-label'>Meta Keyword <small>(eg: horror, comic, tech)</small></label>
						<textarea id = 'meta_keyword' data-name="Meta Keyword" name = 'meta_keyword' placeholder = 'Enter Book Meta Keyword' class = 'form-control required' ></textarea>
						<span class = 'error-message'></span>
					</div>
				</div>
				<div class = 'modal-footer'>
					<input name="submit_data" id="book-btn" type="submit" value="Submit" class="btn btn-info">    
					<button type = 'button' class = 'btn btn-secondary' data-dismiss = 'modal'>Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class = 'modal fade' id = 'dataModal' tabindex = '-1' role = 'dialog' aria-labelledby = 'exampleModalLabel' aria-hidden = 'true'>
	<div class = 'modal-dialog' role = 'document'>
		<div class = 'modal-content'>
			<div class = 'modal-header'>
				<button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>
					<span aria-hidden = 'true'>&times;
					</span>
				</button>
				<h5 class = 'modal-title' id = 'exampleModalLabel'>View Book Detail</h5>			
			</div>
			<div class = 'modal-body' id="book-detail">
				<div class="table-responsive">  
           			<table class="table table-bordered">  
			            <tr>  
			                 <td width="30%"><label>Category</label></td>  
			                 <td width="70%" id="view_category"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Name</label></td>  
			                 <td width="70%" id="view_name"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Price</label></td>  
			                 <td width="70%" id="view_price"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Qty</label></td>  
			                 <td width="70%" id="view_qty"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Image</label></td>  
			                 <td width="70%" id="view_image"></td>  
			            </tr>   
			             <tr>  
			                 <td width="30%"><label>Short Description</label></td>  
			                 <td width="70%" id="view_shortdesc"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Description</label></td>  
			                 <td width="70%" id="view_desc"></td>  
			            </tr>  
			            <tr>  
			                 <td width="30%"><label>Meta Keyword</label></td>  
			                 <td width="70%" id="view_metakeyword"></td>  
			            </tr>  
			             <tr>  
			                 <td width="30%"><label>Status</label></td>  
			                 <td width="70%" id="view_status"></td>  
			            </tr>  
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
require( 'templates/footer.inc.php' );
?>