<?

$style_query = 'SELECT `styleName` FROM `product`
INNER JOIN `style` ON `product`.`styleId` = `style`.`id`
INNER JOIN `type` ON `product`.`typeId` = `type`.`id`
INNER JOIN `category` ON `type`.`categoryId` = `category`.`id`
WHERE `categoryName` = "' . $category . '"
GROUP BY `styleName`
ORDER BY `styleName` ASC';
$style_result = mysqli_query($conn,$style_query);

if (mysqli_num_rows($style_result) > 0) {
    while ($style = mysqli_fetch_array($style_result)) {
        echo '<li><label for="' . $style['styleName'] . '"><input class="selector style" type="checkbox" name="' . $style['styleName'] . '" id="' . $style['styleName'] . '" value="' . $style['styleName'] . '">' . $style['styleName'] . '<span class="checkmark"><i class="bx bx-check"></i></span></label></li>';
    }
}
            
?>