<!DOCTYPE html>
<html>
  <?php
  session_start();
   ?>
</head>
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
  <div class="w3-padding-64 w3-large w3-text-dark-grey" style="font-weight:bold">
    <a href="imageUploader.html?" class="w3-bar-item w3-button">Create Cards</a>
    <a href="buildDeck.php" class="w3-bar-item w3-button">Build Deck</a>
    <a href ="tradeView.php" class ="w3-bar-item w3-button">All Current Trades</a>
    <a href ="viewAllCards.php" class ="w3-bar-item w3-button">View All Cards</a>
    <a href ="tradesForYou.php" class ="w3-bar-item w3-button">Trades For You</a>
    <a href ="myAccount.php" class ="w3-bar-item w3-button">Your Account</a>
    <a href="aboutUs.php" class="w3-bar-item w3-button">About</a>
    <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a>
    <a href="homePage.php" class="w3-bar-item w3-button w3-padding">Log Out</a>
  </div>
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
  <header class="w3-container w3-xlarge w3-text-dark-grey">
    <p class="w3-left">Other Users</p>
    <p class="w3-right">
      <a class="btn btn-large btn-primary logout" href="buildDeck.php">
        <i class="fa fa-clone w3-margin-right" aria-hidden="true"></i>
      </a>
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

   <div class="w3-container w3-text-dark-grey" id="Other Users">
    <p>Recent items</p>
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
    echo "<form method='POST' action='./tradeForm.php'>";
    echo "<p style='color: white'> $path[username] </p>";
    echo "<img src = $path[imagePath] height=90% width=90%><input type='submit' name='receiver' value=$path[username] class='w3-button w3-black'>Trade Now</button></input></img>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

  }

 ?>


  <!-- Subscribe section -->
  <form action = './searchQuery.php' method = 'POST'>
  <div class="w3-container w3-black w3-padding-32">
    <h1>Search</h1>
    <p>To find users by username!</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter username" name = 'username' style="width:100%"></p>
    <button type="submit" class="w3-button w3-red w3-margin-bottom">Search</button>
  </div>
  </form>

  <header class="w3-container w3-xlarge">
    <p class="w3-left w3-text-dark-grey">Your Deck</p>
  </header>
  <div class="w3-container w3-text-dark-grey" id="Other Users">
    <p>Your items</p>
  </div>
  <div class="w3-container w3-black w3-padding-32">
  <?php

    // check that the 'username' key exists
  if (!isset($_SESSION['username'])) {
    // it does; output the message
    echo "You are not logged in!";
    header("Location: login_form.php");
  }
  //set up to display user's deck
  $user = $_SESSION['username'];
  $db_file = '../myDB/spitting.db';
  $db = new PDO('sqlite:' . $db_file);

  //set errormode to use exceptions
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //show each card in the user's deck
  $stmt = $db->prepare('SELECT imagePath FROM Owns NATURAL JOIN Card where username=:username');
  $stmt->bindParam(':username',$user);
  $result = $stmt->execute();
  $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result_set as $path) {
    echo "<div class = 'w3-row-w3'>";
    echo "<div class = 'w3-col l3 s6'>";
    echo "<div class = 'w3-container'>";
    echo "<form method='get' action='./tradeForm.php'>";
    echo "<img src = $path[imagePath] height=100% width=100%</img>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

  }
  ?>
  </div>

  <!-- Footer -->
  <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4">
        <h4>Questions?</h4>
        <p>This website is to appreciate the fine art and photographs of other artist.</p>
        <p>On this website one is allowed to trade their own art for others.</p>
        <p>Please be responsible and enjoy!</p>
      </div>

      <div class="w3-col s4">
        <h4>About</h4>
        <p><a href="aboutUs.php">About us</a></p>
        <p><a href="funnyPage.html">We're hiring</a></p>
      </div>

      <div class="w3-col s4 w3-justify">
        <h4>Help</h4>
        <p><i class="fa fa-fw fa-map-marker"></i> Spitting Image</p>
        <p><i class="fa fa-fw fa-phone"></i> 555-555-5555</p>
        <p><i class="fa fa-fw fa-envelope"></i> ex@mail.com</p>
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

</body>
</html>
