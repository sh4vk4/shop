<?
if(isset($filter['id'])) {
    $productId = $filter['id'];
} elseif(isset($row['id'])) {
    $productId = $row['id'];
}

$review_query = 'SELECT COUNT(`review`.`id`) AS `count`, AVG(`reviewRating`) AS `avg` FROM `review`
INNER JOIN `product` ON `review`.`productId` = `product`.`id`
WHERE `product`.`id` = "' . $productId . '"
GROUP BY `product`.`id`';

$review_result = mysqli_query($conn,$review_query);

if (mysqli_num_rows($review_result) > 0) {
    while ($review = mysqli_fetch_array($review_result)) {
        $reviewRating = (float)$review['avg'];
        $reviewCount = $review['count'];
        // no stars
        if ($reviewRating == 0) {
            $reviewStars = '<i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 
        
        // half star
        elseif ($reviewRating >= 0.1 && $reviewRating <= 0.9 ) {
            $reviewStars = '<i class="bx bx-star-half"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 
        
        // one star
        elseif ($reviewRating == 1) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 
        
        // star and a half
        elseif ($reviewRating >= 1.1 && $reviewRating <= 1.9) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bx-star-half"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 
        
        // two stars
        elseif ($reviewRating == 2) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 

        // two stars and a half
        elseif ($reviewRating >= 2.1 && $reviewRating <= 2.9 ) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star-half"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 
        
        // three stars
        elseif ($reviewRating == 3) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
        } 

        // three stars and a half
        elseif ($reviewRating >= 3.1 && $reviewRating <= 3.9) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star-half"></i><i class="bx bx-star"></i>';
        } 
        
        // four stars
        elseif ($reviewRating == 4) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star"></i>';
        } 

        // four stars and a half
        elseif ($reviewRating >= 4.1 && $reviewRating <= 4.9) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star-half"></i>';
        } 
        
        // five stars
        elseif ($reviewRating == 5) {
            $reviewStars = '<i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i>';
        }

    }
} else {
    $reviewRating = '0';
    $reviewCount = '0';

    $reviewStars = '<i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i><i class="bx bx-star"></i>';
}

$item_card = 
'<div class="rating">
    <p>' . $reviewStars . ' ' . $reviewRating . '</p>
    <p>' . $reviewCount . ' reviews</p>
</div>';

$item_profile = 
'<div class="rating">
    <p> ' . $reviewStars . ' ' . $reviewRating . '</p>
    <a href="#reviews">' . $reviewCount . ' reviews</a>
</div>';

?>