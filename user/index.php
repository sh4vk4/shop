<?

require '../php/connect.php';
session_start();

if (isset($_SESSION['userId'])) {
  
  $query = 'SELECT * FROM `user`
            INNER JOIN `status` ON `user`.`statusId` = `status`.`id`
            WHERE `user`.`id` = "' . $_SESSION['userId'] .'"';
  $result = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
      $userRole = $row['userRole'];
      $userName = $row['userName'];
      $userLogin = $row['userLogin'];
      $userPhoto = $row['userPhoto'];
      $userBanner = $row['userBanner'];
      $userBonusCounter = $row['userBonusCounter'];
      $statusName = $row['statusName'];
    }
  }

  if ($userRole == "admin") {
    $adminPanel = '<li><button id="admin" onclick="switchSidebar(\'adminBody\')"><i class="bx bxs-widget"></i> Admin panel</button></li>';
    $badge = '<i class="bx bxs-shapes"></i>';
  } else {
    $adminPanel = '';
    $badge = '<i class="bx bxs-crown ' . $statusName . '"></i>';
  }

  $query = 'SELECT * FROM `shop` INNER JOIN `user` ON `shop`.`userId` = `user`.`id` WHERE `userId` = "' . $_SESSION['userId'] . '"';
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) != 0) {
    $shopPanel = '<li><button id="shop" onclick="switchSidebar(\'shopBody\')"><i class="bx bxs-shopping-bag-alt"></i> View shop</button></li>';
  } else {
    $shopPanel = '';
  }

  $query = 'SELECT `id` FROM `messages` WHERE `userId` = "' . $_SESSION['userId'] . '"';
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 0) {
    $unread = '';
  } else {
    $unread = 'unread ';
  }

} else {

  header('Location: ../signup/');

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../media/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title><? echo $userName . '\'s profile'?></title>
  </head>
  <body>
    <? include '../php/header.php'; ?>
    <main class="wrap">
      <div class="container">
      <ul class="sidebar">
          <li><button class="active" id="profile" onclick="switchSidebar('profileBody')"><i class='bx bxs-user' id="profile"></i> View profile</button></li>
          <? 
            echo $shopPanel;
            echo $adminPanel;
          ?>
          <hr>
          <li><button id="history" onclick="switchSidebar('historyBody')"><i class='bx bxs-shopping-bags' ></i> History</button></li>
          <li><button id="fav" onclick="switchSidebar('favBody')"><i class="bx bxs-heart"></i> Favorites</button></li>
          <li><button id="rev" onclick="switchSidebar('revBody')"><i class='bx bxs-message-square-check'></i> Reviews</button></li>
          <li><button class="<? echo $unread ?>" id="inbox" onclick="switchSidebar('inboxBody')"><i class='bx bxs-chat'></i> Inbox</button></li>
          <hr>
          <li><button id="address" onclick="switchSidebar('addressBody')"><i class='bx bxs-home-alt-2' ></i> Addresses</button></li>
          <li><button id="payment" onclick="switchSidebar('paymentBody')"><i class='bx bxs-wallet-alt' ></i> Payment</button></li>
          <hr>
          <li><button id="settings" onclick="switchSidebar('settingsBody')"><i class='bx bxs-cog'></i> Settings</button></li>
          <li><a href="../php/logout.php"><i class='bx bxs-door-open' ></i> Logout</a></li>
      </ul>
      </div>
      <?
      
      include '../php/profileBody.php';

      
      
      ?>
    </main>
    <footer></footer>
  </body>
  <script>

    // sidebar switch

    function switchSidebar(divId) {

    //selectors

    // first batch
    const profileSelect = document.getElementById('profile');
    const shopSelect = document.getElementById('shop');
    const adminSelect = document.getElementById('admin');

    //second batch
    const historySelect = document.getElementById('history');
    const favSelect = document.getElementById('fav');
    const revSelect = document.getElementById('rev');
    const inboxSelect = document.getElementById('inbox');

    //third batch
    const addressSelect = document.getElementById('address');
    const paymentSelect = document.getElementById('payment');

    //fourth batch
    const settingsSelect = document.getElementById('settings');

    //body

    //profile
    const profileBody = document.getElementById('profileBody');
    //shop
    const shopBody = document.getElementById('shopBody');
    //admin
    const adminBody = document.getElementById('adminBody');

    //history
    const historyBody = document.getElementById('historyBody');
    //favs
    const favBody = document.getElementById('favBody');
    //revs
    const revBody = document.getElementById('revBody');
    //inbox
    const inboxBody = document.getElementById('inboxBody');

    //addressess
    const addressBody = document.getElementById('addressBody');
    //payment
    const paymentBody = document.getElementById('paymentBody');

    //settings
    const settingsBody = document.getElementById('settingsBody');

    if (divId === 'profileBody') {

      profileSelect.classList.add("active");
      // profileBody.style.display = 'flex';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'none';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';
      

    } if (divId === 'shopBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.add("active");
      // shopBody.style.display = 'flex';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'none';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'adminBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.add("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'historyBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.add("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'favBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.add("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'revBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.add("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'inboxBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.add("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';
    
    } if (divId === 'addressBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.add("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'paymentBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.add("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.remove("active");
      // settingsBody.style.display = 'none';

    } if (divId === 'settingsBody') {

      profileSelect.classList.remove("active");
      // profileBody.style.display = 'none';

      shopSelect.classList.remove("active");
      // shopBody.style.display = 'none';

      adminSelect.classList.remove("active");
      // adminBody.style.display = 'flex';

      historySelect.classList.remove("active");
      // historyBody.style.display = 'none';

      favSelect.classList.remove("active");
      // favBody.style.display = 'none';

      revSelect.classList.remove("active");
      // revBody.style.display = 'none';

      inboxSelect.classList.remove("active");
      // inboxBody.style.display = 'none';

      addressSelect.classList.remove("active");
      // addressBody.style.display = 'none';

      paymentSelect.classList.remove("active");
      // paymentBody.style.display = 'none';

      settingsSelect.classList.add("active");
      // settingsBody.style.display = 'none';

    }

  }

  </script>
</html>
