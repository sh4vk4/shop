<?

$shop_query = 'SELECT `shopName` FROM `shop`
INNER JOIN `product` ON `product`.`shopId` = `shop`.`id`
WHERE `product`.`id` = "' . $productId . '"';

$shop_result = mysqli_query($conn, $shop_query);

if (mysqli_num_rows($shop_result) > 0) {
    while ($shop = mysqli_fetch_array($shop_result)) {
        echo '
        
        <div class="product-buy__shop">
            <i class="bx bxs-store-alt"></i>
            <div class="shop">
              <p>' . $shop["shopName"] . '</p>
              <p><i class="bx bxs-star"></i> 4.8</p>
            </div>
        </div>
        
        ';
    }
}


?>