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
            echo $result_set||"\n";
            echo $_GET["statement"];
              foreach($result_set as $tuple) {
                echo "<font color='white'>$tuple[ssn] $tuple[f_name] $tuple[m_name] $tuple[l_name]</font>";
               }
        }
    ?>

    </body>
</html>
