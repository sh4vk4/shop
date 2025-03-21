<?

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../media/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/style.css">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user list</title>
</head>
<body>
    <? include '../../php/header.php' ?>
    <main class="wrap">
        <?
        
        $query = 'SELECT * FROM `user`';
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_array($result)) {
                echo '<a href="../?id=' . $user['id'] . '">';
                echo '<img style="width: 150px" src="' . $user['userPhoto'] . '">';
                echo '<p>' . $user['userName'] . '</p>';
                echo '</a><br><br>';
            }
        }
        
        ?>
    </main>
</body>
</html>