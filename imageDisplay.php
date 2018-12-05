<html>
<link rel ="stylesheet" type = "text/css" href="templateCSS.css">
<body style="margin-left: 5%" >
<div class="row">
  <?php
  if(isset($_GET['create'])){
  echo "<div class='column' style='width: 40%'>
  <h1> Your card has been created.</h1> <h1>Click it to return home. </h1></br>
 </div>";
 }
 ?>

 <div class="column" style="width: 40%">
  <form action="userHome.php">
    <button type="submit">
      <img style="max-height: 100%" src= 
	      <?php 
		  echo $_GET['path']; 
	      ?>
	  >
    </button>
  </form>
 </div>
 </div>
</body>

</html>