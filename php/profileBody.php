<?

echo '

<section class="userpage" id="profileBody">
    <div class="banner" style="background-image: url(' . $userBanner . ')">
    </div>
    <div class="userpage-heading">
        <div class="userpage-heading__name">
            <div class="icon" style="background-image: url(' . $userPhoto . ')"></div>
              <div class="text">
                <div class="text-name">' . $userName . '
                    ' . $badge . '
                </div>
                <div class="text-login">@' . $userLogin . '</div>
            </div>
        </div>
    </div>
    <div class="userpage-main">
        <div class="userpage-main__progress">
            <div class="level">
                <div class="level-status">' . $statusName . ' Level</div>
                    <div class="level-bonus"><i class="bx bxs-badge-dollar"></i> ' . $userBonusCounter . ' points</div>
                        <div class="level-text">
                            <ul>';
                                include 'status_features.php';
            echo'           </ul>
                    </div>
                </div>
            </div>
            <div class="userpage-main__recentfav">
                <div class="recentfav">
                    <h2>Recent bought <a href="" class="link">View all →</a></h2>
                    <a href="" class="recentfav-item" style="background-image: url(https://i.ibb.co/qjdY1zS/stylite-yu-a-Kj-Ab-P8-Dr-Mw-unsplash.jpg);"></a>
                </div>
            </div>
            <div class="userpage-main__recentfav">
                <div class="recentfav">
                    <h2>Recent favorites <a href="" class="link">View all →</a></h2>';
                  
                  $query = 'SELECT * FROM `favorite`
                            INNER JOIN `user` ON `favorite`.`userId` = `user`.`id`
                            INNER JOIN `product` ON `favorite`.`productId` = `product`.`id`
                            WHERE `userId` = "' . $_SESSION['userId'] . '"
                            ORDER BY `favorite`.`id` DESC
                            LIMIT 4';
                  $result = mysqli_query($conn, $query);

                  if (mysqli_num_rows($result) > 0) {
                    while ($fav = mysqli_fetch_array($result)) {
                      echo '
                      
                      <a href="" class="recentfav-item" style="background-image: url(' . $fav['productMainPhoto'] . ');"></a>
                      
                      ';
                    }
                  } else {
                    echo '<p>No recent favorites!</p>';
                  }
                  
                  echo '
                  
                </div>
            </div>
            <div class="userpage-main__delete">
                <form action="../php/modal.php" method="post">
                    <button>Delete account</button>
                </form>
            </div>
        </div>
    </div>
</section>

';

?>