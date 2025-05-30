<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1); 
    $username = $userinfo['username'];  
    $email = $userinfo['email'];
  ?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My account</title>
  <link rel="stylesheet" href="account.css"/>
  <script src="account.js" defer></script> 
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

  <header id="nav-container">
    <div id="nav-content">
      <div id="site-name">TravelHub</div>
      <nav id="menu-container">
        <a href="articles.php" class="menu-item">Articles</a>
        <a href="articles.php" class="menu-item">Flights</a>
        <a href="#" class="menu-item">Contacts</a>
      </nav>
      <div id="account-button-container">
        <a href="#" class="account-button">Logout</a>
      </div>
    </div>
  </header>

  <div class="account-container">
    <h1><?php echo htmlspecialchars($username); ?>'s Account</h1>
    <div class="account-section">
      <h2>Personal information</h2>
      <p><strong>Username: </strong><?php echo htmlspecialchars($username); ?></p>
      <p><strong>Email: </strong><?php echo htmlspecialchars($email); ?></p>
    </div>

    <div class="account-section">
      <h2>Settings</h2>
        <button class="account-button">Change username</button>
        <button class="account-button">Change password</button>
        <button class="account-button">Delete account</button>
    </div>
    </div>

    <section class="liked-posts-section">
        <h2>Your favourite posts</h2>
        <div id="liked-posts-container"></div>
    </section>

</body>
</html>

