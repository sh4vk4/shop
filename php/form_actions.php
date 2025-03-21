<?

session_start();

require_once 'connect.php';

// checking if a post request is made
if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    if (!empty($_SESSION['userId'])) {

        header ('Location: ../user/');

    } else {

        $errors = [];

            //if its a signup form then
        if ($_POST['submit'] == 'signup') {

            // validate name
            if (empty($_POST['name'])) {
                $errors['name'] = 'Name is required.';
            }

            // validate username
            if (empty($_POST['login'])) {
                $errors['login'] = 'Login is required.';
            } else {
                $query = 'SELECT * FROM `user` WHERE `userLogin` = "' . $_POST['login'] . '"';
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $errors['login'] = 'Login already exists.';
                }
            }

            // validate email
            if (empty($_POST['email'])) {
                $errors['email'] = 'E-mail address is required.';
            } else {
                $query = 'SELECT * FROM `user` WHERE `userEmail` = "' . $_POST['email'] . '"';
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $errors['email'] = 'E-mail already exists.';
                }
            } 

            // validate password
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required.';
            }

            // making sure that the password is confirmed
            if (empty($_POST['repeat_password'])) {
                $errors['password'] = 'Confirm password is required.';
            } elseif ($_POST['password'] != $_POST['repeat_password']) {
                $errors['password'] = 'Passwords do not match.';
            }

            // validate consent
            if (empty($_POST['consent'])) {
                $errors['consent'] = 'Agree with Terms and Services.';
            }

            // if there's no errors and everythings alright
            if (count($errors) == 0) {
                $hash = hash('sha256', $_POST['password']);

                $query = 'INSERT INTO `user` (`userName`, `userEmail`, `userLogin`, `userPassword`)
                        VALUES ("' . $_POST['name'] . '", "' . $_POST['email'] . '", "' . $_POST['login'] . '", "' . $hash . '")';
                $result = mysqli_query($conn, $query);

                $_SESSION['success'] = 'Successfully created a new account!';

                $query = 'SELECT * FROM `user` WHERE `userEmail` = "' . $_POST['email'] . '"';
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($user = mysqli_fetch_array($result)) {
                        $_SESSION['userId'] = $user['id'];
                    }
                }

                header('Location: ../../user/');

            } else {

                $_SESSION['message'] = $errors;
                header('Location: ../signup/');

            }

        }

        if ($_POST['submit'] == 'signin') {

            // validate username
            if (empty($_POST['login'])) {
                $errors['login'] = 'Login is required.';
            } else {
                $query = 'SELECT `id` FROM `user` where `userLogin` = "' . $_POST['login'] . '"';
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    $errors['login'] = 'Wrong login.';
                }
            }

            // validate password
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required.';
            } else {
                $hash = hash('sha256', $_POST['password']);
                $query = 'SELECT `id` FROM `user` where `userPassword` = "' . $hash . '"';
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0) {
                    $errors['password'] = 'Wrong password.';
                }
            }

            // if there's no errors and everythings alright
            if (count($errors) == 0) {

                $query = 'SELECT `id` FROM `user` WHERE `userLogin` = "' . $_POST['login'] . '"';
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($user = mysqli_fetch_array($result)) {
                        $_SESSION['userId'] = $user['id'];
                        $_SESSION['success'] = 'Successfully logged in!';
                    }
                }

                header('Location: ../../user/');

            } else {

                $_SESSION['message'] = $errors;
                header('Location: ../signin/');

            }

        }

    }
}


    // if ($_POST['submit'] == 'signin') {

    //     $query = 'SELECT * FROM `user`
    //               WHERE `userLogin` = "' . $_POST['username'] . '" AND `userPassword` = "' . $_POST['password'] . '"';

    //     $result = mysqli_query($conn, $query);

    //     if (mysqli_num_rows($result) != 0 && empty($_SESSION['userId'])) {
    //         while ($user = mysqli_fetch_array($result)) {
    //             $_SESSION['userId'] = $user['userId'];

    //             header('Location:../../user/');
    //         }
    //     } else {
    //         header('Location:../signin/');
    //     }
    // }


?>