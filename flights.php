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
    <title>TravelHub - Flights</title>
    <link rel="stylesheet" href="flights.css">
   <script src="flights.js" defer></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
  </head>
  
  <body>
    <nav id="nav-container">
    <div id="nav-content">
    
  <a href="home.php" id="site-name">TravelHub</a>

  <div id="menu-container">
      <a class="menu-item" href="home.php">Home</a>
      <a class="menu-item" href="articles.php">Articles</a>
      <a class="menu-item" href="flights.php">Flights</a>
      <a class="menu-item" href="#">Hotels</a>
    </div>

    <div id="account-button-container">
      <a href="account.php" class="account-button"><?php echo htmlspecialchars($username); ?>'s Account</a>
    </div>

  </div>
</nav>

 <section id="flight-section">
    <h1 class="title">Flight Offers</h1>
      
    <form id="flight-search-form">
          
    Departure city:
    <input type="text" id="departure-input" name="departure_city"  placeholder="Departure city name">
            
    Destination city:
    <input type="text" id="destination-input" name="destination_city" placeholder="Destination city name">
            
    Date:
    <input type="date" id="date-input" name="date" placeholder="Flight date (YYYY-MM-DD)">
    
    <input type='submit' id="submit" value='Get Flights'>
    </form>

    <div id="flight-result"></div>
  </section>

</body>
</html>
