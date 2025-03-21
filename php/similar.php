<?

$s_query = 'SELECT `product`.`id`, `productMainPhoto` FROM `product`
WHERE `typeId` = "' . $productType . '"
OR `styleId` = "' . $productStyle . '"
AND NOT `product`.`id` = "' . $productId . '"
ORDER BY RAND()
LIMIT 5';

$s_result = mysqli_query($conn, $s_query);

if (mysqli_num_rows($s_result) > 0) {
    while ($s_row = mysqli_fetch_array($s_result)) {
        echo '
        
        <a href="../item?id=' . $s_row['id'] . '" class="similar-item hover-scaleup" style="background-image: url(' . $s_row["productMainPhoto"] . ');">
            <form action="fav_actions.php" method="post">
                <button type="submit" name="addToFav">
                    <i class="bx bx-bookmark"></i>
                </button>
            </form>
        </a>

        ';
    }
}

?>