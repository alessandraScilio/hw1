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
  <link rel="stylesheet" href="commons.css"/>
  <script src="account.js" defer></script> 
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

  <header id="nav-container">
    <div id="nav-content">
      <div id="site-name">TravelHub</div>
      <nav id="menu-container">
        <a class="menu-item" href="home.php">Home</a>
        <a href="articles.php" class="menu-item">Articles</a>
        <a href="flights.php" class="menu-item">Flights</a>
        <a href="#" class="menu-item">Contacts</a>
      </nav>
      <div id="account-button-container">
        <a href="logout.php" class="account-button">Logout</a>
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
        <button class="account-button" type='change-username' >Change username</button>
        <button class="account-button" type='change-password' >Change password</button>
        <button class="account-button" type='delete-account'  >Delete account</button>
    </div>
    </div>

    <section class="liked-posts-section">
        <h2>Your favourite posts</h2>
        <div id="liked-posts-container"></div>
    </section>

    <section class="bookings-section">
        <h2>Your flight offers</h2>
        <div id="bookings-container"></div>
    </section>


    <footer class="site-footer">
  <div class="footer-container">
    <div class="footer-left">
      <h3>TravelHub</h3>
      <p>Your gateway to unforgettable journeys. Discover, plan, and share travel experiences.</p>
    </div>
    <div class="footer-links">
      <a href="#">Home</a>
      <a href="#">Articles</a>
      <a href="#">Flights</a>
      <a href="#">Hotels</a>
      <a href="#">Account</a>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 TravelHub. All rights reserved.
  </div>
</footer>


</body>
</html>

