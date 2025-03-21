<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../media/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../style/style.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>full item card</title>
  </head>
  <body>
    <? include '../../php/header.php' ?>
    <main>
        <section class="product wrap">
    <?

        $productId = $_GET['id'];

        $query = 'SELECT `product`.`id`, `productName`, `productMainPhoto`, `typeId`, `typeName`, `styleId`, `productPrice`, `discountId`, `discountPercent` FROM `product`
        INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
        LEFT JOIN `discount` ON `product`.`discountId` = `discount`.`id`
        WHERE product.id = "' . $productId . '"';
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $productType = $row['typeId'];
                $productStyle = $row['styleId'];

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
                include '../../php/item_profile.php';
            }
        }

    ?>
        </section>
      <section class="similar wrap">
          <h3>Similar products</h3>
          <? include '../../php/similar.php' ?>
      </section>
      <section class="reviews wrap" id="reviews">
        <h2>Reviews</h2>
      </section>
    </main>
    <footer class="wrap"></footer>
  </body>
</html>
