<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html  lang="en">
  <?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1); 
    $username = $userinfo['username'];  
  ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TravelHub - Home</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="commons.css"/>
  <script src="home.js" defer></script> 
</head>
<body>

<nav id="nav-container">
  <div id="nav-content">
    
    <a href="home.php" id="site-name">TravelHub</a>

    <div id="menu-container">
      <a class="menu-item" href="articles.php">Articles</a>
      <a class="menu-item" href="flights.php">Flights</a>
      <a class="menu-item" href="#">Hotels</a>
      <a class="menu-item" href="#">Channels</a>
    </div>

    <div id="account-button-container">
      <a href="account.php" class="account-button"><?php echo htmlspecialchars($username); ?>'s Account</a>
    </div>

  </div>
</nav>


  <section class="articles-preview-section">
  <h2 class="section-title">Most liked articles</h2>

  <div id="articles-grid"></div>

  <div class="more-articles-link">
    <a href="articles.php" class="arrow-link">View All Articles →</a>
  </div>
</section>

<section class="travel-deals-section">

  <div class="deal-container">
    <div class="deal-text">
      <h2>Find the Best Flight Deals</h2>
      <p>Save on your next adventure with exclusive offers and real-time flight tracking.  
      Explore destinations worldwide at unbeatable prices.</p>
      <a href="flights.php" class="deal-button">View Flight Offers →</a>
    </div>
    <div class="deal-image">
      <img src="pics/flight.jpg" alt="Flight deals">
    </div>
  </div>

  <div class="deal-container">
    <div class="deal-image">
      <img src="pics/hotel.avif" alt="Hotel deals">
    </div>
    <div class="deal-text">
      <h2>Top Hotel Deals Just for You</h2>
      <p>Enjoy comfort and luxury at the best prices.  
      Discover special rates and curated stays in the world's most beautiful destinations.</p>
      <a href="hotels.php" class="deal-button">View Hotel Offers →</a>
    </div>
  </div>

</section>

<section class="travel-channels-section">
  <h2>Explore Our Travel Channels</h2>
  <p class="channels-subtitle">Follow our adventures across multiple platforms</p>

  <div class="channel-row">
    <img src="pics/youtube.png" alt="YouTube Channel">
    <div class="channel-description">
      <h3>YouTube</h3>
      <p>Watch travel documentaries, vlogs, and tips on stunning destinations.</p>
    </div>
  </div>

  </div>
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

