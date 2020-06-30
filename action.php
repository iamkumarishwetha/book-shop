<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$grand_total=0;
	
require("classes/manage-database.php"); 
 if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip_add = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip_add = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip_add = $_SERVER['REMOTE_ADDR'];
 }
if(isset($_POST['GET_CATEGORY']))
{
	$sql="SELECT * FROM categories WHERE status=1 ORDER BY category ASC";
	$countRows=$dbobj->numRows($sql);
	if($countRows > 0)
	{
		$rows=$dbobj->getData($sql);
		foreach ($rows as $row) {
			echo '<a href="javascript:void(0)" class="list-group-item book-category" data-id="'.$row['id'].'">'.$row['category'].'</a>';                        
		}
	}
	else
	{
			echo '<a href="javascript:void(0)" class="list-group-item">No Categories</a>';  
	}
}
if(isset($_POST['GET_BOOK']))
{
	$sql="SELECT books.*,categories.category FROM books JOIN categories ON books.category_id=categories.id WHERE books.status=1";
	if(isset($_POST['cat_id']) && $_POST['cat_id'] != '')
	{
		$cat_id=$dbobj->escapeString($_POST['cat_id']);
		$sql.=" AND books.category_id=$cat_id";
	}
	if(isset($_POST['search']) && $_POST['search'] != '')
	{
		$search=$dbobj->escapeString($_POST['search']);
		$sql.=" AND books.name LIKE '%$search%'";
	}
	$sql.=" ORDER BY books.id DESC";

	if(isset($_POST['limit']) && $_POST['limit'] != ''){
		$limit=$dbobj->escapeString($_POST['limit']);
		$sql.=" LIMIT $limit";
	}
	$countRows=$dbobj->numRows($sql);
	if($countRows > 0)
	{
		$rows=$dbobj->getData($sql);
		foreach ($rows as $row) {
                echo '<div class="col-lg-3 col-md-6 mb-4 single-book">
            			<div class="card h-100">
							<a href="/book-shop/book/id/'.$row['id'].'">
								<div class="card-img-top">
									<img class="book-cover-img" src="'.PRODUCT_IMAGE_SITE_PATH . $row['image'] . '" alt="Book Image">
								</div>
							</a>
              				<div class="card-body">
                				<h4 class="card-title">
                  					<a href="/book-shop/book/id/'.$row['id'].'">'.$row['name'].'</a>
                				</h4>
                				<div class="book-info">
                					<span class="float-left"><i class="fas fa-rupee-sign"></i> ' . $row['price'] . '</span> <span class="float-right"><i class="fas fa-folder-open"></i><span class="text-muted"> ' . $row['category'] . '</span></span>
                				</div>
                			</div>
              				<div class="card-footer">
              					<input type="hidden" class="qty" value="1">
              					<input type="hidden" class="book-id" data-id="' . $row['id'] .'">';
              					if($row['qty'] >0)
              					{
              						echo '<button class="btn btn-sm book">Add to cart</button>';
              					}		
                				else
                				{
                					echo '<button class="btn btn-sm">Out of Stock</button>';
                				}

              				echo '</div>
            			</div>
          			</div>';  
				}
			}
		else{
		echo 	'<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <h4>Not Available..!!!</h4>
               	</div>';
	}
	
}

if(isset($_POST['GET_DETAIL']))
{
	if(isset($_POST['book_ID']) && $_POST['book_ID'] != '')
	{
		$book_ID=$dbobj->escapeString($_POST['book_ID']);
		$sql="SELECT books.*,categories.category FROM books JOIN categories ON books.category_id=categories.id WHERE books.id='$book_ID'";
		$countRows=$dbobj->numRows($sql);
		if($countRows > 0)
		{
			$row=$dbobj->getData($sql,true);
			
			echo '<div class="row">
					<div class="col-lg-5">
						<div class="card">
          					<img class="card-img-top img-fluid" src="'.PRODUCT_IMAGE_SITE_PATH . $row['image'] . '" alt="Book Image">
        				</div>
       				</div>
     				 <div class="col-lg-7">
        				<div class="card">
          					<div class="card-body">
            					<h1 class="mt-2 mb-4">'. $row['name'] . '</h1> 
            					<h3 class="card-title"><i class="fas fa-folder-open"></i> Category <span class="text-muted">: '. $row['category'] . '</span></h3>
            					<h4><i class="fas fa-rupee-sign"></i> '. $row['price'] . '</h4>
            					<p class="card-text">'. $row['short_desc'] . '</p>';
            					if($row['qty'] >0)
              					{
	            					echo '<div class="d-flex">
	              							<h5 for="staticEmail" class="col-form-label mr-2">Qty</h5>
	              								<div class="qty-wrapper">';
	              								$qty=1;
			              						if(isset($_SESSION['USER_ID'])){
			              							$user_id=$_SESSION['USER_ID'];
			              							$cart_sql="SELECT qty FROM cart WHERE user_id='$user_id' AND book_id='$book_ID'";
			              							if($dbobj->numRows($cart_sql) == 1){
			              								$cart_row=$dbobj->getData($cart_sql,true);
			              								$qty=$cart_row['qty'];
			              							}
			              						}
			              						else{

			              							$cart_sql="SELECT qty FROM cart WHERE user_id < 0 AND book_id='$book_ID' AND ip_address='$ip_add'";
			              							if($dbobj->numRows($cart_sql) == 1){
			              								$cart_row=$dbobj->getData($cart_sql,true);
			              								$qty=$cart_row['qty'];
			              							}
			              						}
			              						$options = '';
		      									$selected='';
		      									$max=$row['qty'] > 10?10:$row['qty'];
		      				
		      									for($count=1;$count<=$max;$count++)
												{
													$selected=($count == $qty)?"selected":"";
													$options .= '<option value="' . $count . '"'.$selected.' >' . $count . '</option>';
												}
	                								echo '<select name="qty" class="qty">' . $options . '</select>
	              								</div>
	            							</div>
	            							<input type="hidden" name="book_id" class="book-id" data-id="'.$row['id'].'">';
	            				}
            					if($row['qty'] >0)
              					{
              						echo '<input type="button" class="btn btn-lg mt-4 book_add_to_cart" value="Add to cart">';
              					}		
                				else
                				{
                					echo '<button class="btn btn-lg mt-4">Out of Stock</button>';
                				}
            					
          					echo '</div>
        				</div>
      				</div>
   				</div>';
    			echo '<div class="row">
      				<div class="col-12">
            			<div class="card card-outline-secondary my-4">
          					<div class="card-header">
            					Description
          					</div>
          					<div class="card-body description">lemme check'. $row['description'] . '</div>
        				</div>
      				</div>
    			</div>';
    		}
    		else{

    			echo "Not Availbale";
    		}
    	}
}

if(isset($_POST["addToCart"])){
	$bid =$dbobj->escapeString($_POST["bookID"]);
	$qty =$dbobj->escapeString($_POST["qty"]);
	
	if(isset($_SESSION['USER_ID'])){
		$user_id = $_SESSION['USER_ID'];
		$select_qty_cart="SELECT id FROM cart WHERE book_id='$bid' AND user_id = '$user_id'";
		if($dbobj->numRows($select_qty_cart) > 0){

			echo "
				<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is already added into the cart Continue Shopping..!</b>
				</div>
			";
		
		}
		else
		{
			$sql = "INSERT INTO `cart`(`book_id`, `ip_address`,`user_id`, `qty`) VALUES ('$bid','$ip_add','$user_id','$qty')";
			$res=$dbobj->execute($sql);
			if($res){
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
					}
		}
	}
	else{
		$select_qty_cart="SELECT id FROM cart WHERE ip_address = '$ip_add' AND book_id = '$bid' AND user_id <  0";
		if($dbobj->numRows($select_qty_cart) > 0){

			echo "
				<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is already added into the cart Continue Shopping..!</b>
				</div>
			";
		
		}
		else
		{
			$sql = "INSERT INTO `cart`(`book_id`, `ip_address`,`user_id`, `qty`) VALUES ('$bid','$ip_add','-1','$qty')";
			$res=$dbobj->execute($sql);
			if($res){
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
					}
		}
	}
}
if(isset($_POST["addToCartFromDetail"])){
	$bid =$dbobj->escapeString($_POST["bookID"]);
	$qty =$dbobj->escapeString($_POST["qty"]);
	
	if(isset($_SESSION['USER_ID'])){
		$user_id = $_SESSION['USER_ID'];
		$select_qty_cart="SELECT id FROM cart WHERE book_id='$bid' AND user_id = '$user_id'";
		if($dbobj->numRows($select_qty_cart) > 0){

			$update_sql="UPDATE cart SET qty='$qty' WHERE book_id = '$bid' AND user_id = '$user_id'";
			$result_update_sql=$dbobj->execute($update_sql);
			if ($result_update_sql) {
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
				exit();
			}
		
		}
		else
		{
			$sql = "INSERT INTO `cart`(`book_id`, `ip_address`, `user_id`, `qty`) VALUES ('$bid','$ip_add','$user_id','$qty')";
			$result=$dbobj->execute($sql);
			if ($result) {
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
				exit();
			}
		}
	}
	else{
		$select_qty_cart="SELECT id FROM cart WHERE ip_address = '$ip_add' AND book_id = '$bid' AND user_id <  0";
		if($dbobj->numRows($select_qty_cart) > 0){

			$update_sql="UPDATE cart SET qty='$qty' WHERE ip_address = '$ip_add' AND book_id = '$bid' AND user_id < 0";
			$result_update_sql=$dbobj->execute($update_sql);
			if ($result_update_sql) {
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
				exit();
			}
		
		}
		else
		{
			$sql = "INSERT INTO `cart`(`book_id`, `ip_address`, `user_id`, `qty`) VALUES ('$bid','$ip_add','-1','$qty')";
			$result=$dbobj->execute($sql);
			if ($result) {
				echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is Added to Cart..!</b>
					</div>";
				exit();
			}
		}
	}
	
}
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["USER_ID"])) {
		$uid=$_SESSION["USER_ID"];
		$sql = "SELECT SUM(qty) AS count_item FROM cart WHERE user_id = $uid";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT SUM(qty) AS count_item FROM cart WHERE ip_address = '$ip_add' AND user_id < 0";
	}
	$result=$dbobj->getData($sql,true);
	echo $result["count_item"];
	exit();
}

if (isset($_POST["getCartItem"])) {

	if (isset($_SESSION["USER_ID"])) {
		//When user is logged in this query will execute
		$sql = "SELECT b.id as book_id,b.name,b.price,b.image,b.qty as book_qty,c.id as cart_id,c.qty FROM books b,cart c WHERE b.id=c.book_id AND c.user_id='".$_SESSION['USER_ID']."'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT b.id as book_id,b.name,b.price,b.image,b.qty as book_qty,c.id as cart_id,c.qty FROM books b,cart c WHERE b.id=c.book_id AND c.ip_address='$ip_add' AND c.user_id < 0";
	}
	$query = $dbobj->execute($sql);
	//display cart item in dropdown menu
	if(isset($_POST['cart_dropdown']))
	{
		echo '<div class="inner-div">';
		if ($dbobj->numRows($sql) > 0) {
		$rows=$dbobj->getData($sql);
		foreach ($rows as $row) {
			echo '<div class="d-flex mb-3">
              		<div class="thumb">
                  		<a href="/book-shop/book/id/'.$row['book_id'].'"><img src="/book-shop/images/product/'.$row['image'].'" alt="product images" class="img-responsive img-thumbnail cart-book-cover-img"></a>
              		</div>
              		<div class="content">
                		<h6><a href="/book-shop/book/id/'.$row['book_id'].'">'.$row['name'].'</a></h6>
                		<span class="prize"><i class="fas fa-rupee-sign"></i>'.$row['price'].'</span>
                		<div class="book_info d-flex justify-content-between mt-2">
                  			<span class="qun">Qty: '.$row['qty'].'</span>
                  			<ul class="d-flex justify-content-end">
                   				<li><a href="javascript:void(0)" data-id="'.$row['cart_id'].'" class="remove"><i class="fas fa-trash"></i></a></li>
                  			</ul>
                		</div>
             	 	</div>
            	</div>';			
		}
		echo '</div>';
		?>
			<div class="cart-checkout-btn mt-2">
              <a href="/book-shop/cart" class="btn btn-sm btn-block">View Cart</a>
            </div>
		<?php
		exit();
		}
		else
		{
			echo '<p>Your Shopping Cart is empty!</p>';
		}
	}

	if(isset($_POST['cart_page']))
	{
		if ($dbobj->numRows($sql) > 0) {
		echo '<div class="row"><div class="col-lg-8 col-md-8"><table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Book</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>';
		$rows=$dbobj->getData($sql);
		$subtotal=0;
		$shipping=0;
		foreach ($rows as $row) {
			$total = $row['price'] * $row['qty'];
			$subtotal=$subtotal+$total;
			echo '<tr>
      				<td><img src="images/product/'.$row['image'].'" alt="product images" class="img-responsive img-thumbnail cart-book-cover-img"></td>
      				<td>'.$row['name'].'</td>
      				<td><i class="fas fa-rupee-sign"></i> <span class="price">'.$row['price'].'</span></td>
      				<td>';
      				$options = '';
      				$selected='';
      				$max=$row['book_qty'] > 10?10:$row['book_qty'];
      				
      				for($count=1;$count<=$max;$count++)
					{
						$selected=($count == $row["qty"])?"selected":"";
						$options .= '<option value="' . $count . '"'.$selected.' >' . $count . '</option>';
					}
	                echo '<select name="qty" class="cart_qty">' . $options . '</select>
      				</td><td><i class="fas fa-rupee-sign"></i> <span class="total">'.$total.'</span></td>
      				<th scope="row"><a href="javascript:void(0)" data-id="'.$row['cart_id'].'" class="remove text-danger"><i class="fas fa-times fa-2x"></i></a></th>
    			</tr>';			
		}
		?>
		</tbody>
			<tfoot>
				<tr>
					<th colspan="3"></th>
					<th>Total</th>
					<th colspan="2"><i class="fas fa-rupee-sign"></i> <?php echo $subtotal; ?> </th>
				</tr>
				<tr>
					<td colspan="6"><a href="/book-shop" class="btn">Continue Shopping</a></td>
            	</tr>
			</tfoot>
          </table>
      </div>
      <div class="col-lg-4 col-md-4 ">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <h5 class="card-header">Order Summary</h5>
              <div class="card-body">
              	<div class="row mb-4">
              		<div class="col-md-6">Sub Total</div>
              		<div class="col-md-6"><i class="fas fa-rupee-sign"></i> <?php echo $subtotal; ?></div>
              	</div>
              	<div class="row">
              		<div class="col-md-6">Shipping</div>
              		<div class="col-md-6">Free</div>
              	</div>
              </div>
              <div class="card-footer">
              	<div class="row grand-total">
              		<div class="col-md-6">Grand Total</div>
              		<div class="col-md-6"><i class="fas fa-rupee-sign"></i> <?php echo $subtotal + $shipping; ?></div>
              		<div class="col-12 mt-4">
          				<a href="/book-shop/checkout" class="btn btn-lg">Proceed to Checkout</a>
         			 </div>
              	</div>
              </div>  
            </div>
          </div>
        </div>
      </div>
  </div>
		<?php
		exit();
		}
		else
		{   echo '<div class="text-center">';
			echo '<h2 class="mb-4">Your Shoping cart is empty!</h2>';
			echo '<a href="/book-shop" class="btn btn-lg text-center">Start Shopping Now</a>';
			echo '</div>';
		}
	}
}

if (isset($_POST["updateCartItem"])) {
	$cart_id = $_POST["cart_id"];
	$cart_qty = $_POST["qty"];
	$sql = "UPDATE cart SET qty='$cart_qty' WHERE id = '$cart_id'";
	
	if($dbobj->execute($sql)){
		echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your Shopping Cart is updated</b>
				</div>";
		exit();
		/*}*/
	}
}
if (isset($_POST["removeItemFromCart"])) {
	$cart_id = $_POST["cart_id"];
	
	$sql = "DELETE FROM cart WHERE id = '$cart_id'";
	
	if($dbobj->execute($sql)){
		echo "<div class='alert'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Book is removed from cart</b>
				</div>";
		exit();
	}
}

if(isset($_POST['user_login']))
{
	$email=$dbobj->escapeString($_POST['login-email']);
	$password=$dbobj->escapeString($_POST['login-password']);
	$hashpassword = md5($password);

	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashpassword'";
	if($dbobj->numRows($sql) == 1){

			$row = $dbobj->getData($sql,true);
			$_SESSION['USER_ID']=$row['id'];
			$_SESSION['USER_NAME']=$row['name'];

			$user_id=$_SESSION['USER_ID'];

			$cart_select_sql="SELECT * FROM cart WHERE user_id='$user_id'";
			if($dbobj->numRows($cart_select_sql) > 0){
				$get_cart_rows=$dbobj->getData($cart_select_sql);

				$cart_sql = "SELECT * FROM cart WHERE ip_address = '$ip_add' AND user_id < 0";

				if($dbobj->numRows($cart_sql) > 0){
					$cart_rows = $dbobj->getData($cart_sql);
					foreach($cart_rows as $cart_row){
						$without_userid_bookid=$cart_row['book_id'];
						$without_userid_qty=$cart_row['qty'];
						$without_userid_cartid=$cart_row['id'];

						foreach ($get_cart_rows as $get_cart_row) {
							
							$with_userid_bookid=$get_cart_row['book_id'];
							$with_userid_qty=$get_cart_row['qty'];
							$with_userid_cartid=$get_cart_row['id'];

							if($without_userid_bookid == $with_userid_bookid){

								$newqty = $without_userid_qty + $with_userid_qty;

								$updatecart_sql = "UPDATE cart SET qty='$newqty' WHERE id='".$with_userid_cartid."'";
								$dbobj -> execute($updatecart_sql);

								$delete_cart_sql="DELETE FROM cart WHERE id='$without_userid_cartid'";
								$dbobj -> execute($delete_cart_sql);


							}
							else{

								$updatecart_sql = "UPDATE cart SET user_id='".$_SESSION['USER_ID']."'  WHERE ip_address = '$ip_add' AND user_id < 0";
								$dbobj -> execute($updatecart_sql);
							}
						}
					}
					
				}


			}
			else{
				$cart_sql = "SELECT * FROM cart WHERE ip_address = '$ip_add' AND user_id < 0";

				if($dbobj->numRows($cart_sql) > 0){
					$cart_rows = $dbobj->getData($cart_sql);
					foreach($cart_rows as $cart_row){

						$updatecart_sql = "UPDATE cart SET user_id='".$_SESSION['USER_ID']."' WHERE id='".$cart_row['id']."'";
						$dbobj -> execute($updatecart_sql);

					}
					
				}
			}
			

		echo "success";
		exit();
	}
	else{
		echo "Please register before login..!";
		exit();
	}
}
if(isset($_POST['user_register'])){

	$name=$dbobj->escapeString($_POST['full-name']);
	$email=$dbobj->escapeString($_POST['register-email']);
	$password=$dbobj->escapeString($_POST['register-password']);
	$mobileno=$dbobj->escapeString($_POST['mobile-no']);

	//existing email address in our database
	$sql = "SELECT id FROM users WHERE email = '$email'" ;
	$count_email = $dbobj -> numRows($sql);
	if($count_email > 0){
		echo "Email Address is already available Try Another email address";
		exit();
	} else {
		$password = md5($password);
		$date = date('Y-m-d h:i:s');
		$sql = "INSERT INTO users (name,password,email,mobile,added_on) VALUES ('$name','$password','$email','$mobileno','$date')";
		$_SESSION['USER_ID'] = $dbobj -> lastinsertID($sql);
		$_SESSION['USER_NAME'] = $name;
		
		$sql = "SELECT * FROM cart WHERE ip_address='$ip_add' AND user_id < 0";
		if($dbobj -> numRows($sql) > 0)
		{
			$sql_update = "UPDATE cart SET user_id = '".$_SESSION['USER_ID']."' WHERE ip_address='$ip_add' AND user_id < 0";
			if($dbobj -> execute($sql_update)){
				//echo "cart_register_success";
				//exit();
			}
		}
		else
		{
			echo "register_success";
			exit();
		}
		
	}
}
if (isset($_POST['submit_checkout'])) {
	$street_address=$dbobj->escapeString($_POST['street-address']);
	$city=$dbobj->escapeString($_POST['city']);
	$post_code=$dbobj->escapeString($_POST['post-code']);
	$payment_type=$dbobj->escapeString($_POST['optpayment']);
	$user_id=$_SESSION['USER_ID'];

	$payment_status='pending';

	$added_on=date('Y-m-d h:i:s');
	
	$order_sql="INSERT INTO `order_tbl`(`user_id`, `address`, `city`, `pincode`, `payment_type`, `payment_status`, `txnid`, `added_on`) VALUES ('$user_id','$street_address','$city','$post_code','$payment_type','$payment_status','','$added_on')";

	$order_id=$dbobj->lastinsertID($order_sql);

	if(isset($order_id) && $order_id != '')
	{
		$_SESSION['ORDER_ID']=$order_id;
		$cart_sql="SELECT cart.*,books.price,books.qty as book_qty FROM cart INNER JOIN books ON cart.book_id=books.id WHERE user_id='$user_id'";

		$get_cart_data=$dbobj->getData($cart_sql);
		foreach($get_cart_data as $cart_row)
		{
			$book_id=$cart_row['book_id'];
			$qty=$cart_row['qty'];
			$price=$cart_row['price'];
			$total_price=$price * $qty;
			$grand_total=$grand_total + $total_price;
			$order_detail_sql="INSERT INTO `order_detail`(`order_id`, `book_id`, `qty`, `price`, `order_status`) VALUES ('$order_id','$book_id','$qty','$price',1)";
			$run_orderdetail_sql=$dbobj->execute($order_detail_sql);

			if($run_orderdetail_sql)
			{
				$newqty=$cart_row['book_qty'] - $qty;
				$update_qty="UPDATE books SET qty = ".$newqty." WHERE id = ".$book_id;
				$dbobj -> execute($update_qty);
			}
		}

		$delete_cart_sql = "DELETE FROM cart WHERE user_id = '$user_id'";
		$result_query=$dbobj->execute($delete_cart_sql);

		if($result_query)
		{
			if($payment_type=='Payu'){
				$MERCHANT_KEY = "gtKFFx"; 
				$SALT = "eCwWELxi";
				$hash_string = '';
				//$PAYU_BASE_URL = "https://secure.payu.in";
				$PAYU_BASE_URL = "https://test.payu.in";
				$action = '';
				$posted = array();
				if(!empty($_POST)) {
				  foreach($_POST as $key => $value) {    
					$posted[$key] = $value; 
				  }
				}
				
				$user_sql="select * from users where id='$user_id'";
				$userArr=$dbobj->getData($user_sql,true);
				
				$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			
				$formError = 0;
				$posted['txnid']=$txnid;
				$posted['amount']=$grand_total;
				$posted['firstname']=$userArr['name'];
				$posted['email']=$userArr['email'];
				$posted['phone']=$userArr['mobile'];
				$posted['productinfo']="productinfo";
				$posted['key']=$MERCHANT_KEY ;
				$hash = '';
				$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
				if(empty($posted['hash']) && sizeof($posted) > 0) {
				  if(
						  empty($posted['key'])
						  || empty($posted['txnid'])
						  || empty($posted['amount'])
						  || empty($posted['firstname'])
						  || empty($posted['email'])
						  || empty($posted['phone'])
						  || empty($posted['productinfo'])
						 
				  ) {
					$formError = 1;
				  } else {    
					$hashVarsSeq = explode('|', $hashSequence);
					foreach($hashVarsSeq as $hash_var) {
					  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					  $hash_string .= '|';
					}
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
				  }
				} elseif(!empty($posted['hash'])) {
				  $hash = $posted['hash'];
				  $action = $PAYU_BASE_URL . '/_payment';
				}


				$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="'.SITE_PATH.'book-shop/payment_complete" /><input type="hidden" name="furl" value="'.SITE_PATH.'book-shop/payment_fail"/><input type="submit" style="display:none;"/></form>';
				echo $formHtml;
				echo '<script>document.getElementById("payuForm").submit();</script>';
			}
			if($payment_type=='COD')
			{
				?>
				<script>
					window.location.href='/book-shop/thank-you';
				</script>
				<?php
			}	
		}		

	}
}

if(isset($_POST['getOrderItem']))
	{
		$user_id=$_SESSION['USER_ID'];
		$sql = "SELECT b.image,b.name,d.qty,d.price,o.id,o.payment_type,o.added_on,s.name as status FROM order_tbl o INNER JOIN order_detail d ON o.id=d.order_id INNER JOIN books b ON d.book_id=b.id INNER JOIN order_status s ON d.order_status=s.id WHERE user_id ='$user_id'";
		if ($dbobj->numRows($sql) > 0) {
		echo '<div class="row">
				<div class="col-12">
					<table class="table">
            			<thead class="thead-light">
		              		<tr>
				                <th scope="col">#</th>
				                <th scope="col">Book</th>
				                <th scope="col">Title</th>
				                <th scope="col">Price</th>
				                <th scope="col">Quantity</th>
				                <th scope="col">Total</th>
								<th scope="col">Payment Method</th>
				                <th scope="col">Order Date</th>
				                <th scope="col">Status</th>
				             </tr>
		          		</thead>
		         		<tbody>';
		$rows=$dbobj->getData($sql);
		foreach ($rows as $row) {
			$total = $row['price'] * $row['qty'];
			$date=strtotime($row['added_on']);
			$added_on=date('d-m-Y',$date);
			echo '<tr>
					<td>'.$row['id'].'</td>
      				<td><img src="images/product/'.$row['image'].'" alt="product images" class="img-responsive img-thumbnail cart-book-cover-img"></td>
      				<td>'.$row['name'].'</td>
      				<td><i class="fas fa-rupee-sign"></i> <span class="price">'.$row['price'].'</span></td>
      				<td>'.$row['qty'].'</td>
      				</td><td><i class="fas fa-rupee-sign"></i> <span class="total">'.$total.'</span></td>
      				<td>'.$row['payment_type'].'</td>
      				<td>'.$added_on.'</td>
      				<th>'.$row['status'].'</th>
    			</tr>';			
		}
		?>
		</tbody>
      </table>
      </div>
  </div>
		<?php
		exit();
		}
		else
		{   echo '<div class="text-center">';
			echo '<h2 class="mb-4">You have not placed any order yet!</h2>';
			echo '<a href="/book-shop" class="btn btn-lg text-center">Continue Shopping</a>';
			echo '</div>';
		}
	}
?>

 
            