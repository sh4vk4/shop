<?

$g_query = 'SELECT * FROM product_photos
INNER JOIN product ON product_photos.productId = product.id
WHERE product.id = "' . $productId . '"';

$g_result = mysqli_query($conn, $g_query);

if (mysqli_num_rows($g_result) > 0) {
    while ($gallery = mysqli_fetch_array($g_result)) {
        echo '
        <div class="preview hover-scaleup" style="background-image: url(' . $gallery['p_photoLink'] . ');"></div>';
    }
}

?>