<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $query = "SELECT * FROM users WHERE email = '".$email."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                $_SESSION["_agora_username"] = $entry['username'];
                $_SESSION["_agora_user_id"] = $entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["email"]) || isset($_POST["password"])) {
        $error = "Inserisci email e password.";
    }
?>


<html>
<!DOCTYPE html>
<head>
    <title>TravelHub</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    </head>
<body>

    <div id="login-container">
        <h1>Welcome to Travel Hub</h1>
             <?php
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                unset($_SESSION['errors']);
             ?>

        <form id = "form" method="post">
            
        <div class="username">
            <label for="username">Email:</label><br>
            <input type="text" id="username" name="email"><br>
        </div>

        <div class="password">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
        </div>

         <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="Login">
                    </div>
                </div>    

        </form> 
        <p>Don't have an account? <a href="signup.php">Register here</a></p>
        <p id="error-message"></p>
    </div>
    </body>
</html>