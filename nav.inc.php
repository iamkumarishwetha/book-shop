
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="/book-shop"><span>Book</span> Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/book-shop">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/book-shop">Book</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="GET" action="/book-shop/search"  onsubmit="return prettySubmit(this, event);">
        <input class="form-control mr-sm-2" type="search" placeholder="Enter Book Name." name="q" aria-label="Search">
        <button class="btn my-2 my-sm-0 search" type="submit">Search</button>
      </form>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cart <i class="fas fa-shopping-cart nav-icon"></i><span class="count-cart"></span>
          </a>
          <div class="dropdown-menu cart-wrapper" aria-labelledby="navbarDropdown" id="cart_product">
           
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user nav-icon"></i>
            <?php
            if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] != '')
            {
              echo 'hi, '.$_SESSION['USER_NAME'];          
            }
            ?>
          </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
             <?php
            if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] != '')
            {
              echo '<a class="dropdown-item" href="/book-shop/my-order">My Order</a>';
              echo '<div class="dropdown-divider"></div>';
              echo  '<a class="dropdown-item" href="/book-shop/logout">Logout</a>';  
            }
            else
            {
              echo '<a class="dropdown-item" href="/book-shop/login">Login/Register</a>';
            }
            ?>
               
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

 <div id="product_msg"></div>
  <!--?php echo $_SERVER['REQUEST_URI'] . '<br>';
    print_r($_GET); 
  ?-->

