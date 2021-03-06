<!DOCTYPE html>
<html>
<title>Spitting Image</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Spitting Image</b></h3>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a href="imageUploader.html?" class="w3-bar-item w3-button">Create Cards</a>
    <a href="buildDeck.php" class="w3-bar-item w3-button">Build Deck</a>
    <!-- <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn"> -->
      <!-- Jeans <i class="fa fa-caret-down"></i> -->
    </a>
    <!-- <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
      <a href="#" class="w3-bar-item w3-button">Relaxed</a>
      <a href="#" class="w3-bar-item w3-button">Bootcut</a>
      <a href="#" class="w3-bar-item w3-button">Straight</a>
    </div> -->
    <a href="aboutUs.php" class="w3-bar-item w3-button">About</a>
    <a href="myAccount.php" class="w3-bar-item w3-button">My Account</a>
  </div>
  <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">Spitting Image</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Other Users</p>
    <p class="w3-right">
      <i class="fa fa-clone w3-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
  </header>

  <!-- Image header -->
  <!-- <div class="w3-display-container w3-container">
    <img src="" alt="Usernames" style="width:100%"> -->
    <!-- <div class="w3-display-topleft w3-text-white" style="padding:24px 48px"> -->
      <!-- <h1 class="w3-jumbo w3-hide-small">New posts!</h1> -->
      <!-- <h1 class="w3-hide-large w3-hide-medium">New posts!</h1> -->
      <!-- <h1 class="w3-hide-small">COLLECTION</h1> -->
      <!-- <p><a href="#Usernames" class="w3-button w3-black w3-padding-large w3-large">Trade Now</a></p> -->
    <!-- </div> -->
  <!-- </div> -->

  <div class="w3-container w3-text-grey" id="Other Users">
    <p>8 items</p>
  </div>
  <?php
  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);

  //set errormode to use exceptions
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare('SELECT * from Owns NATURAL JOIN Card group by username');
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_set as $path) {
    echo "<div class = 'w3-row-w3'>";
    echo "<div class = 'w3-col l3 s6'>";
    echo "<div class = 'w3-container'>";
    echo "<form method='get' action='./tradeForm.php'>";
    echo "<p> $path[username] </p>";
    echo "<img src = $path[imagePath] height=90% width=90%><button class='w3-button w3-black'>Trade Now</button></img>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

  }
  ?>

  <!-- Product grid -->
  <div class="w3-row w3">
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <img src="https://i.pinimg.com/originals/6d/69/0f/6d690f08d223a4890553cd81b24a6e94.png" style="width:100%">
        <p>Test Training Card<br><b>Username</b></p>
      </div>
      <div class="w3-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIhH_vd1nz2o0D8WKfxNbPmPgLUfNOWpgJvK8IPk8J2QSv0_4u" style="width:100%">
        <p>Card2<br><b>Username</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="https://i.ebayimg.com/images/g/D5UAAOSw3RZaPx8Q/s-l300.jpg" style="width:100%">
          <span class="w3-tag w3-display-topleft">New</span>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Trade Now <i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        <p>card3<br><b>Username</b></p>
      </div>
      <div class="w3-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXy4nHDvKbOM6uDn9gKQCv7f3ArGbr18XggoeJ_-A3vCGepP_CuA" style="width:100%">
        <p>card4<br><b>Username</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <img src="http://www.mypokecard.com/my/galery/nzgtVDJMbKip.jpg" style="width:100%">
        <p>card5<br><b>Username</b></p>
      </div>
      <div class="w3-container">
        <div class="w3-display-container">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8IbZhwI2aidBP9hQPTcWdhMzDts8ROyrUOsHrWIvfNW6lMjfF" style="width:100%">
          <span class="w3-tag w3-display-topleft">Sale</span>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        <p>Card6<br><b class="w3-text-red">Username</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_bS0lroLGriwDBNBfiNb7Z4sr5Pke7ncUa9C4zJXl6NZNdfmk" style="width:100%">
        <p>Card7<br><b>Username</b></p>
      </div>
      <div class="w3-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0EdtRgzU90tqBvGSbXHLuKPwDxybKDVg-hdDKM3XwGzGi737CHQ" style="width:100%">
        <p>Card8<br><b>Username</b></p>
      </div>
    </div>
  </div>

  <header class="w3-container w3-xlarge">
    <p class="w3-left">Your Deck</p>
  </header>

  <div class="w3-container w3-text-grey" id="Your Deck">
    <p>8 items</p>
  </div>

  <!-- Product grid -->

  <!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32">
    <h1>Search</h1>
    <p>To find users by username!</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter username" style="width:100%"></p>
    <button type="button" class="w3-button w3-red w3-margin-bottom">Search</button>
  </div>

  <!-- Footer -->
  <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4">
        <h4>Contact</h4>
        <p>Questions? Go ahead.</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Send</button>
        </form>
      </div>

      <div class="w3-col s4">
        <h4>About</h4>
        <p><a href="aboutUs.php">About us</a></p>
        <p><a href="#">We're hiring</a></p>
        <p><a href="#">Support</a></p>
        <p><a href="#">Help</a></p>
      </div>

      <div class="w3-col s4 w3-justify">
        <h4>Store</h4>
        <p><i class="fa fa-fw fa-map-marker"></i> Spitting Image</p>
        <p><i class="fa fa-fw fa-phone"></i> 555-555-5555</p>
        <p><i class="fa fa-fw fa-envelope"></i> ex@mail.com</p>
        <h4>We accept</h4>
        <p><i class="fa fa-fw fa-cc-amex"></i> Amex</p>
        <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
        <br>
        <i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
        <i class="fa fa-instagram w3-hover-opacity w3-large"></i>
        <i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity w3-large"></i>
        <i class="fa fa-twitter w3-hover-opacity w3-large"></i>
        <i class="fa fa-linkedin w3-hover-opacity w3-large"></i>
      </div>
    </div>
  </footer>

  <div class="w3-black w3-center w3-padding-24">Powered by Green House Goons</div>

  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Accordion
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

<?php
  session_start();
  echo $_SESSION['USER_DATA']['username'];
?>

</body>
</html>
