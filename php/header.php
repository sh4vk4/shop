<?

require 'connect.php';

session_start();

include 'loading.php';

if(!$conn) {
    die("Connection failed " . mysqli_connect_error());
} elseif($conn) {
    echo '<header class="wrap">
    <nav>
      <a href="../../" class="logo"><i class="bx bxs-customize"></i> SHOP.</a>
      <ul>
        <li><a href="../../clothes/">Clothes</a></li>
        <li><a href="../../jewelry/">Jewelry</a></li>
        <li><a href="../../bags/">Bags</a></li>
        <li><a href="../../misc/">Misc</a></li>
      </ul>
      <div class="user">
        <a href="../../cart/"><i class="bx bxs-cart-alt"></i></a>
        <a href="'; 
        if (empty($_SESSION['userId'])) {
          echo '../../signup/';
        } else {
          echo '../../user/';
        }
        echo '"><i class="bx bxs-user"></i></a>
      </div>
      <i class="bx bx-menu-alt-right" id="burger-menu"></i>
    </nav>
  </header>';
}



?>