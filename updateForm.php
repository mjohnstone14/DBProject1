
<!DOCTYPE html>
<html>
<head>
    <link rel ='stylesheet' type = 'text/css' href='core.css'>
    <h1>Update Passenger</h1>
</head>
<body>
<p>
<?php
 if(isset($_GET['error'])) {
     echo "<font color = 'red'> Please enter a valid first name <br></font>";
 }
 if(isset($_GET['error2'])) {
    echo "<font color = 'red'> Please enter a valid last name <br></font>";
 }
 if(isset($_GET['error3'])) {
    echo "<font color = 'red'> SSN must be provided <br></font>";
 }
 if(isset($_GET['error4'])) {
    echo "<font color = 'red'> SSN must be 11 characters long <br></font>";
 }
?>
</p>
 <div class='content'>
    <form action='updateFormHandler.php' method='POST'>
        <div>
            <label for='first_name'>First Name: <abbr title='required'>*</abbr></label>
            <input id='first_name' type='text' name='first_name' size = '25' value=<?php echo $_POST["first_name"]?>>
            <label for='m_name'>Middle Name: </label>
            <input id='m_name' type='text' name='m_name' size = '25' value=<?php echo $_POST["m_name"]?>>
            <label for='last_name'>Last Name: <abbr title='required'>*</abbr></label>
            <input id='last_name' type='text' name='last_name' size = '25' value=<?php echo $_POST["last_name"]?>>
            <label for='ssn'>SSN: <abbr title='required'>*</abbr></label>
            <input id='ssn' type='text' name='ssn' size = '25' value=<?php echo $_POST["ssn"]?>>
            <input id='oldssn' type='hidden' name='oldssn' value=<?php echo $_POST["ssn"]?>>
        </div>
        <input name='mySubmit' type='submit' value='Submit!' />
    </form>
</div>

</body>
</html>

