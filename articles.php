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
  ?>

<htlm>
  <!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title>TravelHub - Articles</title>
    <link rel="stylesheet" href="articles.css">
   <script src="articles.js" defer></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
  </head>
  
  <body>
    <nav id="nav-container">
    <div id="nav-content">
    
    <div id="site-name">TravelHub</div>
    <div id="menu-container">
      <a class="menu-item" href="#">Articles</a>
      <a class="menu-item" href="#">Flights</a>
      <a class="menu-item" href="#">Hotels</a>
      <a class="menu-item" href="#">Channels</a>
    </div>

    <div id="account-button-container">
      <a href="account.php" class="account-button"><?php echo htmlspecialchars($username); ?>'s Account</a>
    </div>

  </div>
</nav>

<!--Search-->
<section class="search-section">
  <h2>Find Travel Articles</h2>
  <form id="search-form" method='POST'>
    <div class="form-group">
      <label for="continent">Continent</label>
      <input type="text" id="continent" name="continent" placeholder="e.g. Europe">
    </div>
    
    <div class="form-group">
      <label for="country">Country</label>
      <input type="text" id="country" name="country" placeholder="e.g. Italy">
    </div>
    
    <div class="form-group">
      <label for="city">City</label>
      <input type="text" id="city" name="city" placeholder="e.g. Rome">
    </div>
    <button type="submit" class="search-button">Search</button>
  </form>
</section>

  <div id="articles-container"></div>
  </body>
</html>