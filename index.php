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
          <div id="site-name">TRAVEL HUB</div>
          <div id="menu-container">
            <div class = "menu-item">Home</div>
            <div class = "menu-item">Destinations</div>
            <div class = "menu-item">Forum</div>
            <div class = "menu-item">Contacts</div>
          </div>

          <div id="social-icons-container">
            <img class= "social-icon" src="pics/instagram_icon.svg" >
            <img class= "social-icon" src= "pics/facebook-icon.svg" >
            <img class= "social-icon" src="pics/tiktok-icon.svg" > 
          </div>
          <div id="curtain-menu"><img id="curtain-menu-image" src="pics/curtain-menu-img.svg"></div>
        </nav>

          <div id="mobile-menu-container">
              <div class = "mobile-menu-item">about</div>
              <div class = "mobile-menu-item">travel resources</div>
              <div class = "mobile-menu-item">for brands</div>
              <div class = "mobile-menu-item">affiliate disclaimer</div>

              <div id="social-icons-container">
                <img class= "social-icon" src="pics/instagram_icon.svg" >
                <img class= "social-icon" src= "pics/facebook-icon.svg" >
                <img class= "social-icon" src="pics/tiktok-icon.svg" > 
              </div>
          </div>

        <header id="header-container">
            <h1 id="title">Travel Hub</h1>

            <div id="link-container">
            <a href="http://localhost/hw1/login.php">Login</a>
            <a href="http://localhost/hw1/signup.php">Sign up</a>
            </div>
          
        
        </header>

        <span id = "features-container">
            <div id="features-text">MY TIPS HAVE BEEN FEATURED IN...</div>
          <div id="logos-container">
            <img class="logo" src="pics/good-morning-america-logo-svg.png"> 
            <img class="logo" src="pics/people-logo.png"> 
            <img class="logo" src="pics/nyp-logo.png"> 
            <img class="logo" src="pics/daily-mail.png">    
            <img class="logo" src="pics/nyt.png">    
            <img class="logo" src="pics/tl.png">
          </div>
        </span>

        <section id="travel-resourses-container">
          <h1 class="t-r-title">Travel resourses</h1>
            
          <div class="t-r-grid-container">
              <!--Colonna 1-->
              <div    data-type="mobile-show" 
                      class="t-r-grid-item">
                <h1   class="t-r-g-title"> Guides & Itineraries</h1>
                <img  class="t-r-g-image" src="pics/grid-image-1.png">
                <p    class="t-r-p"> My guides are packed with things to do, 
                                    helpful</br> links, & resources to help you plan. 
                                    PLUS you’ll</br>get my Google Map of saved locations!</p>
                <div  class="t-r-g-button">View guides</div>
              </div>
              
              <!--Colonna 2-->
              <div    data-type="mobile-hidden" 
                      class="t-r-grid-item"> 
                <h1   class="t-r-g-title"> Travel Credit Cards</h1>
                <img  class="t-r-g-image" src="pics/grid-image-2.png">
                <p    class="t-r-p"> These are my favorite travel credit cards of 
                                      the</br> month to help you book flights & hotels</br>
                                      for nearly free! </p>
                <div  class="t-r-g-button">Learn more</div>
              </div>
              
              <!--Colonna 3-->
              <div    data-type="mobile-hidden" 
                      class="t-r-grid-item"> 
                <h1   class="t-r-g-title"> Favorite Hotels</h1>
                <img  class="t-r-g-image" src="pics/grid-image-3.png">
                <p    class="t-r-p"> Need to find the perfect hotel for your trip?</br> 
                                      Here are my favorites in Japan, Iceland,</br> Mexico, 
                                      & more!</p>
                <div  class="t-r-g-button">Check hotels</div>
              </div>
              
              <!--Colonna 4-->
              <div    data-type="mobile-hidden" 
                      class="t-r-grid-item">  
                <h1   class="t-r-g-title"> Pre-Trip Checklist</h1>
                <img  class="t-r-g-image" src="pics/grid-image-4.png">
                <p    class="t-r-p"> Headed abroad? This checklist will walk you</br> through 
                                     all of the things you need to do</br> to prepare for an 
                                     international trip!</p>
                <div  class="t-r-g-button">Get checklist</div>
                </div>
            </div>

            <button class="show-buttons" 
                    id="show-more"> Show more</button>
            
            <button class="show-buttons" 
                    id="show-less"> Show less</button>

          </section>

          <!--RECENT POST SECTION-->
          <section id="Recent-post-section">
            <h1 class="t-r-title">Recent posts</h1>
            
            <div id="general-bar">
              <div>Featured</div>

              <div id="carousel-box">
              <div data-order="first" class="Carousel-Icon">&#60;</div>
              <div data-order="second" class="Carousel-Icon">></div>
            </div>
            </div>

            <section class="t-r-grid-container">
             
              <!--Colonna 1-->
              <section data-status='shown' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-1.jpg">
                <div class="paragraph-container">
                <h1   class="post-title">Your Ultimate Guide to Travel Credit Cards in 2025</h1>
                
                <div class="interactions-container">
                    <div class="actions-container"> 
                      <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                      <div class="action-icon">   <img src="comment.svg"></div>
                      <div class="action-icon">   <img src="share.svg"></div>
                    </div>
                      <p class="Read-More">2k likes, 200 comments</p>
                </div>

                <p    class="post-paragraph">Travel credit cards quite literally changed 
                                  my life and I want to help them change yours too!
                                  These recommendations will help you travel more, 
                                  fly in business class, fly in ANY class for nearly free, 
                                  AND stay in hotels around the world without spending
                                   hundreds or thousands of dollars. </p>
               <h2 class="Read-More">Read More →</br>Travel Tips, Credit Cards
               </h2>
                </div>
              </section>

              <!--Colonna 2-->
              <section data-status='shown' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-2.jpg">
                <div class="paragraph-container">
                <h1   class="post-title">10-Day New Zealand Itinerary: Highlights and Hidden Gems</h1>
                
                <div class="interactions-container">
                  <div class="actions-container"> 
                    <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                    <div class="action-icon">   <img src="comment.svg"></div>
                    <div class="action-icon">   <img src="share.svg"></div>
                  </div>
                    <p class="Read-More">0.8k likes, 48 comments</p>
                </div>
              
                <p    class="post-paragraph">If you're dreaming of a New Zealand adventure,  
                                            this 10-day itinerary is for you! I created a 
                                            super detailed itinerary complete with things 
                                            to do at each stop, my hotel recommendations, 
                                            and even my map of saved locations to make your
                                            trip planning effortless. </p>
                <h2 class="Read-More">Read More →</br>New Zealand, Itinerary</h2>
              </div>
              </section>

              <!--Colonna 3-->
              <section data-status='shown' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-3.jpg">
              
                <div class="paragraph-container">
                <h1   class="post-title">GO-TO Travel Apps & Sites to Plan Like a Pro</h1>
                
                <div class="interactions-container">
                  <div class="actions-container"> 
                    <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                    <div class="action-icon">   <img src="comment.svg"></div>
                    <div class="action-icon">   <img src="share.svg"></div>
                  </div>
                    <p class="Read-More">1.2k likes, 180 comments</p>
                </div>
                
                <p    class="post-paragraph">These are some of my favorite travel apps and 
                                            websites to help you plan your trips like a pro! 
                                            From finding cheap flights and booking the perfect 
                                            stay to organizing itineraries, this guide covers my go-to
                                            tools for stress-free travel. </p>
                <h2 class="Read-More">Read More →</br>Travel tips</h2>
              </div>
              </section>

              <!--Colonna 4: nascosta -->
              <section data-status='hidden' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-4.jpg">
              
                <div class="paragraph-container">
                <h1   class="post-title">Top 10 Most Beautiful Airports I've ever seen</h1>
                
                <div class="interactions-container">
                  <div class="actions-container"> 
                    <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                    <div class="action-icon">   <img src="comment.svg"></div>
                    <div class="action-icon">   <img src="share.svg"></div>
                  </div>
                    <p class="Read-More">2.9k likes, 300 comments</p>
                </div>
                
                <p    class="post-paragraph">Travelling allows you to see a lot of different 
                                              kinds of airport architecture. These are the ones 
                                              that really took my breath away and that are now set in my
                                              mind forevere. Aren't you curious to take a look? </p>
                <h2 class="Read-More">Read More →</br>Most beautifil airports</h2>
              </div>
              </section>

              <!--Colonna 5: nascosta -->
              <section data-status='hidden' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-5.jpg">
              
                <div class="paragraph-container">
                <h1   class="post-title">Useful travel tips for long flights</h1>
                
                <div class="interactions-container">
                  <div class="actions-container"> 
                    <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                    <div class="action-icon">   <img src="comment.svg"></div>
                    <div class="action-icon">   <img src="share.svg"></div>
                  </div>
                    <p class="Read-More">1.5k likes, 10 comments</p>
                </div>
                
                <p    class="post-paragraph">During intercontinental flights it's not easy to
                                             concentrate or make the most of long flight hours. 
                                             Come with me and discover my essential tips to tackle 
                                             these kind of flights. <p>
                <h2 class="Read-More">Read More →</br>Long flight tips</h2>
              </div>
              </section>

              <!--Colonna 6: nascosta -->
              <section data-status='hidden' class="t-r-grid-item">
                <img  class="t-r-g-image" src="post-image-6.webp">
              
                <div class="paragraph-container">
                <h1   class="post-title">What about traveling with pets?</h1>
                
                <div class="interactions-container">
                  <div class="actions-container"> 
                    <div class="action-icon">   <img class ="like-image" src="like.svg"></div>
                    <div class="action-icon">   <img src="comment.svg"></div>
                    <div class="action-icon">   <img src="share.svg"></div>
                  </div>
                    <p class="Read-More">1k likes, 20 comments</p>
                </div> 
                
                <p    class="post-paragraph">Traveling with pets can be challgening, however
                                             don't panic, read my article that collects 
                                             some of my best (and worst) travel experiences
                                             that I made with my dog (Bit).<p>
                <h2 class="Read-More">Read More →</br>Traveling with pets experiences</h2>
              </div>
              </section>
            </section>
          </section>
        </section>
      </body>
</html>

  