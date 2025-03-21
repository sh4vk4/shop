<? 

require '../php/connect.php'; 
session_start();

include '../php/loading.php';

if (isset($_SESSION['userId'])) {
  header('Location: ../user/');
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
    <title>sign in</title>
  </head>
  <body>
    <main>
      <section class="signform">
      <a href="../">← Go back</a>
        <h1>Welcome back!</h1>
        <form action="../../php/form_actions.php" method="POST">
          <label
            ><input type="text" placeholder="Login" name="login" id="login" require
          /></label>
          <label
            ><input type="password" placeholder="Password" name="password" id="password" require
          /></label>
          <label for="remember"><input class="selector" type="checkbox" name="remember" id="remember">Remember me<span class="checkmark"><i class="bx bx-check"></i></span></label>
          <?
          
          if (!empty($_SESSION['message'])) {
            echo '<ul class="message">';
            echo '<li>' . implode("</li><li>", $_SESSION['message']) . "</li>";
            echo '</ul>';

            unset($_SESSION['message']);
          }
          
          ?>
          <div>
            <button class="primary" type="submit" name="submit" value="signin">Sign in →</button>
            <p>Don't have an account? <a href="../signup">Sign up.</a></p>
          </div>
        </form>
      </section>
      <section class="signimage"></section>
    </main>
  </body>
</html>