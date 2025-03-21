<?

$type_query = 'SELECT `typeName` FROM `product`
INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
INNER JOIN `category` ON `type`.`categoryId` = `category`.`id`
WHERE `categoryName` = "' . $category . '"
GROUP BY `typeName`
ORDER BY `typeName` ASC';
$type_result = mysqli_query($conn,$type_query);

if (mysqli_num_rows($type_result) > 0) {
    while ($type = mysqli_fetch_array($type_result)) {
        echo '<li><label for="' . $type['typeName'] . '"><input class="selector type" type="checkbox" name="' . $type['typeName'] . '" id="' . $type['typeName'] . '" value="' . $type['typeName'] . '">' . $type['typeName'] . '<span class="checkmark"><i class="bx bx-check"></i></span></label></li>';
    }
}
            
?>