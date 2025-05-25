<?php

require_once 'auth.php';

if (checkAuth()) {
    header("Location: home.php");
    exit;
}

if (
    !empty($_POST["username"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["confirm-password"])
) {
    $error = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    // USERNAME
    if (!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        $error[] = "Username non valido";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $res = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già utilizzato";
        }
    }

    // PASSWORD
    if (strlen($_POST["password"]) < 8) {
        $error[] = "Caratteri password insufficienti";
    }

    // CONFERMA PASSWORD
    if ($_POST["password"] !== $_POST["confirm-password"]) {
        $error[] = "Le password non coincidono";
    }

    // EMAIL
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email non valida";
    } else {
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Email già utilizzata";
        }
    }

    $_SESSION['errors'] = $error;

    // REGISTRAZIONE
    if (count($error) == 0) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(username, password, email) VALUES('$username', '$password', '$email')";

        if (mysqli_query($conn, $query)) {
            $_SESSION["_agora_username"] = $_POST["username"];
            $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }
    }

    mysqli_close($conn);
} else if (isset($_POST["username"])) {
    $error = array("Riempi tutti i campi");
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sign Up - TravelHub</title>
  <link rel="stylesheet" href="signup.css">
  <script src='signup.js' defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
</head>
<body>
  <div id="signup-container">
    <h1>Create Your Account</h1>
    <form id="signup-form" method="post" enctype="multipart/form-data" autocomplete="off">

      <div class="username">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
        <span class="error-message"></span>
      </div> 

      <div class="email">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
        <span class="error-message"></span>
      </div>

      <div id="specifiche">
        <strong>Specifiche della password:</strong><br>
        • Minimo 8 caratteri<br>
        • Almeno una lettera maiuscola e un numero<br>
        • Almeno un carattere speciale (!@#$%^&*)<br>
      </div>

      <div class="password">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="error-message"></span>
      </div>

      <div class="confirm-password">
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
        <span class="error-message"></span>
      </div>

      <input type="submit" value="Sign Up">
    </form>

   <?php 
    
    if (!empty($_SESSION['errors'])) {
        echo "<div id='error-box'><ul>";
        foreach ($_SESSION['errors'] as $e) {
                echo "<li>$e</li>";
    }
    echo "</ul></div>";
    unset($_SESSION['errors']);
    }
  ?>

    <p>Already have an account? <a href="login.php">Login here</a></p>
    <p id="error-message"></p>
  </div>
</body>
</html>
