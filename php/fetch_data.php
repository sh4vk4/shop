<?

require_once 'connect.php';

if(isset($_POST["action"])) {
    
    if ($_POST['category'] == "Clothes") {
        $destination = 'clothes';
    } elseif ($_POST['category'] == "Jewelry") {
        $destination = 'jewelry';
    } elseif ($_POST['category'] == "Bags") {
        $destination = 'bags';
    } elseif ($_POST['category'] == "Misc") {
        $destination = 'misc';
    }

    $query = 'SELECT `product`.`id`, `productName`, `productMainPhoto`, `productPrice`, `discountId`, `discountPercent`, `typeName`, `categoryName`  FROM `product`
           LEFT JOIN `discount` ON `product`.`discountId` = `discount`.`id`
           INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
           LEFT JOIN `style` ON `product`.`styleId` = `style`.`id`
           INNER JOIN `category` ON `type`.`categoryId` = `category`.`id`
           LEFT JOIN `review` ON `review`.`productId` = `product`.`id`';

    if(isset($_POST['category'])) {
        $query .= ' WHERE `categoryName` = "' . $_POST['category'] . '"';
    }

    if(isset($_POST['min_price'], $_POST['max_price']) && !empty($_POST['min_price']) && !empty($_POST['max_price'])) {
        $query .= ' AND `productPrice` BETWEEN "' . $_POST['min_price'] . '" AND "' . $_POST['max_price'] . '"';
    }

    if(isset($_POST['type'])) {
        $type_filter = implode('","', $_POST['type']);
        $query .= ' AND `typeName` IN("' . $type_filter . '")';
    }

    if(isset($_POST['style'])) {
        $style_filter = implode('","', $_POST['style']);
        $query .= ' AND `styleName` IN("' . $style_filter . '")';
    }

    if(isset($_POST['discount'])) {
        $query .= ' AND `discountId` > 0';
    }

    $query .= ' GROUP BY `product`.`id`';

    if(isset($_POST['reviews']) && empty($_POST['rating'])) {
        $query .= ' HAVING COUNT(`review`.`id`) > 0';
        $query .= ' ORDER BY COUNT(`review`.`id`) DESC';
    } elseif(isset($_POST['reviews']) && isset($_POST['rating'])) {
        $query .= ' HAVING COUNT(`review`.`id`) > 0 AND AVG(`reviewRating`) >= 4';
        $query .= ' ORDER BY AVG(`reviewRating`) AND COUNT(`review`.`id`) DESC';
    } elseif(empty($_POST['reviews']) && isset($_POST['rating'])) {
        $query .= ' HAVING AVG(`reviewRating`) >= 4';
        $query .= ' ORDER BY AVG(`reviewRating`) DESC';
    } elseif(empty($_POST['rating']) && empty($_POST['reviews']) && isset($_POST['min_price'], $_POST['max_price']) && !empty($_POST['min_price']) && !empty($_POST['max_price'])) {
        $query .= ' ORDER BY `productPrice`';
    } elseif(empty($_POST['rating']) && empty($_POST['reviews']) && empty($_POST['min_price']) && empty($_POST['max_price'])) {
        $query .= ' ORDER BY RAND()';
    }

    $filter_result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($filter_result) > 0) {
        while ($filter = mysqli_fetch_array($filter_result)) {
            if ($filter['discountPercent'] > 0) {
                $discount = $filter['discountPercent'] / 100;
                $newPrice = $filter['productPrice'] * $discount;
                $price = round($filter['productPrice'] - $newPrice, 2);
                $oldprice = $filter['productPrice'];
                $oldprice_span = '
                <span class="price-old">' . $oldprice .
                '</span>';
            } else {
                $price = $filter['productPrice'];
                $oldprice = '';
                $oldprice_span = '';
            }
            
            echo '
                <a href="../' . $destination . '/item?id=' . $filter['id'] . '" class="productlist-item hover-scaleup">
                    <div class="image" style="background-image: url(' . $filter['productMainPhoto'] . ');">
                        <form action="fav_actions.php" method="post">
                            <button type="submit" name="addToFav">
                                <i class="bx bx-bookmark"></i>
                            </button>
                        </form>
                    </div>
                    <div class="content">
                    <p class="productname">' . $filter['productName'] . ' ' . $filter['typeName'] . '</p>';
                            require 'item_reviews.php';
                            echo $item_card;
                    echo    '
                        <p class="price">$' . $price . $oldprice_span . '</p>
                    </div>
                </a>';
    
        }
    } else {
        echo 'No products here! Yet ;)';
    }
}

// if(isset($_POST['min_price']) && isset($_POST['max_price'])) {
//     $min_price = $_POST['min_price'];
//     $max_price = $_POST['max_price'];
//     $category = $_POST['category'];

//     // $price_filter = implode();

//     $filter_query = 'SELECT `product`.`id`, `productName`, `productMainPhoto`, `productPrice`, `discountId`, `discountPercent`, `typeName`, `categoryName` FROM `product`
//           LEFT JOIN `discount` ON `product`.`discountId` = `discount`.`id`
//           INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
//           INNER JOIN `category` ON `type`.`categoryId` = `category`.`id`
//           WHERE `categoryName` = "' . $category . '"
//           AND `productPrice` BETWEEN "' . $min_price . '" AND "' . $max_price . '"
//           ORDER BY `product`.`productPrice` ASC';
//     $filter_result = mysqli_query($conn, $filter_query);

    

?>