<htlm>
  <!DOCTYPE html>
  <head>
    <title>TravelHub</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
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

        <div id="auth-buttons">
        <a class="auth-button" href="http://localhost/hw1/login.php">Login</a>
        <a class="auth-button signup" href="http://localhost/hw1/signup.php">Sign Up</a>
        </div>
      </div>
    </nav>

   <header id="header-container">
  <div class="overlay"></div>
  <div class="header-content">
    <h1 id="title">TravelHub</h1>
    <div class="divider-line"></div>
    <p id="subtitle">Your personal travel center</p>
    <div class="auth-buttons">
      <a href="login.php" class="auth-btn">Login</a>
      <a href="signup.php" class="auth-btn secondary">Sign up</a>
    </div>
  </div>
</header>

<section class="services-section">
  <div class="services-container">
    <h2>Our Services</h2>
    <p class="services-subtitle">Discover everything TravelHub offers to enhance your journeys.</p>
    
    <div class="services-grid">
      <div class="service-card">
        <h3>Exclusive Deals</h3>
        <p>Access members-only discounts on flights, hotels, and experiences.</p>
      </div>
      <div class="service-card">
        <h3>Travel Articles</h3>
        <p>Read curated stories, guides, and insights from seasoned travelers around the globe.</p>
      </div>
      <div class="service-card">
        <h3>Itinerary Planner</h3>
        <p>Create and customize your travel plans with our smart itinerary builder.</p>
      </div>
      <div class="service-card">
        <h3>Community Tips</h3>
        <p>Get practical advice and hidden gems shared by our vibrant travel community.</p>
      </div>
    </div>
  </div>
</section>


  <section class="travel-articles-intro">
       <div class="intro-container">
        <div class="intro-text">
          <h2>Discover Our Travel Articles</h2>
        <p>Authentic stories, unforgettable destinations, and exclusive tips await you.</br>
        Log in to your account to access reserved content and get inspired for your next adventure.</p>
        <a href="login.php" class="cta-button">Log in to read</a>
        </div>
      </div>
  </section>

   <span id = "features-container">
            <div id="features-text">TRAVEL HUB HAS BEEN FEATURED IN...</div>
          <div id="logos-container">
            <img class="logo" src="pics/good-morning-america-logo-svg.png"> 
            <img class="logo" src="pics/people-logo.png"> 
            <img class="logo" src="pics/nyp-logo.png"> 
            <img class="logo" src="pics/daily-mail.png">    
            <img class="logo" src="pics/nyt.png">    
            <img class="logo" src="pics/tl.png">
          </div>
        </span>


  <footer class="site-footer">
  <div class="footer-container">
    <div class="footer-left">
      <h3>TravelHub</h3>
      <p>Your guide to the world’s most inspiring travel experiences.</p>
    </div>
    <div class="footer-links">
      <a href="#">About</a>
      <a href="#">Articles</a>
      <a href="#">Contact</a>
      <a href="#">Login</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 TravelHub. All rights reserved.</p>
  </div>
</footer>


</body>
</html>

  