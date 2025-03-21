<?

session_start();

if ($_POST['submit'] == "delete") {
    $query = 'DELETE * FROM `user` WHERE `id` = "' . $_SESSION['userId'] . '"';
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../signup/');
        session_destroy();
    }
}

if ($_POST['submit'] == "not_delete") {
    header('Location: ../user/');
}

?>