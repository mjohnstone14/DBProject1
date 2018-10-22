<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type = "text/css" href="core.css">
        <h1>Query Form</h1>
    </head>
    <body>
    <div class="content">
        <form action="queryPageHandler.php" method="POST">
            select from passengers where  <input id="statement" name="statement" type="text" size="75" />
          <input name="submit" type="submit">
        </form>
    </div>
</br>
    <?php 
        if(isset($_GET["results"])){
            $result_set = $_GET["results"];
            echo $result_set;
              foreach($result_set as $tuple) {
                echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]";
               }
        }
    ?>

    </body>
</html>
