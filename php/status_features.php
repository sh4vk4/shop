<?

$query = 'SELECT `s_featureDesc` FROM `user`
          INNER JOIN `status` ON `user`.`statusId` = `status`.`id`
          LEFT JOIN `status_feature` ON `status_feature`.`statusId` = `status`.`id`
          WHERE `user`.`id` = "' . $_SESSION['userId'] .'"';
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result)) {
    while($status_feature = mysqli_fetch_array($result)) {
        echo '<li>' . $status_feature['s_featureDesc'] . '</li>';
    }
}

?>