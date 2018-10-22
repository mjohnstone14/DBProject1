<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type = "text/css" href="core.css">
        <h1>Query Form</h1>
    </head>
    <body>
    <div class="content">
        <form action="queryPageHandler.php" method="POST">
            select from passengers where  <input name="statement" type="text" size="75" />
          <input name="submit" type="submit">
        </form>
    </div>
    </body>
</html>
