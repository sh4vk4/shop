<?

$query = 'SELECT `product`.`id`, `productName`, `productMainPhoto`, `productPrice`, `discountId`, `discountPercent`, `typeName`, `categoryName` FROM `product`
          LEFT JOIN `discount` ON `product`.`discountId` = `discount`.`id`
          INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
          INNER JOIN `category` ON `type`.`categoryId` = `category`.`id`
          WHERE `categoryName` = "' . $category . '"';
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        if ($row['discountPercent'] > 0) {
            $discount = $row['discountPercent'] / 100;
            $newPrice = $row['productPrice'] * $discount;
            $price = round($row['productPrice'] - $newPrice, 2);
            $oldprice = $row['productPrice'];
            $oldprice_span = '
            <span class="price-old">' . $oldprice .
            '</span>';
        } else {
            $price = $row['productPrice'];
            $oldprice = '';
            $oldprice_span = '';
        }
        
        echo '
            <a href="../clothes/item?id=' . $row['id'] . '" class="productlist-item hover-scaleup" id="">
                <div class="image" style="background-image: url(' . $row['productMainPhoto'] . ');">
                    <i class="bx bx-bookmark"></i>
                </div>
                <div class="content">
                    <p class="productname">' . $row['productName'] . ' ' . $row['typeName'] . '</p>
                        <div class="rating">
                            <p>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star-half"></i> 4.9
                            </p>
                            <p>124 reviews</p>
                        </div>
                    <p class="price">$' . $price . $oldprice_span . '</p>
                </div>
            </a>';

    }
} else {
    echo 'No products here! Yet ;)';
}

?>