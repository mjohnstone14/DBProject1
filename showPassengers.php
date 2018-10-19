<!DOCTYPE html>
<html>
<body>
<h2>List of all passengers</h2>
<p>
    <?php

        //path to the SQLite database file
        $db_file = './myDB/airport.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all passengers, and store the result set
            //$query_str = "select * from passengers where ssn='$_GET[passenger_ssn]';";
            //$result_set = $db->query($query_str);

            //prepared statement for select
            $stmt = $db->prepare("SELECT * FROM passengers");
            $result = $stmt->execute();
            $result_set = $result->fetchArray();
            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            foreach($result_set as $tuple) {
                 echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]";

                 echo "<form action="passengerForm.html" method="post">
                 <input type="hidden" name="ssn" value=$tuple[ssn]/>
                 <input type="hidden" name="first_name" value=$tuple[f_name]/>
                 <input type="hidden" name="m_name" value=$tuple[m_name]/>
                 <input type="hidden" name="last_name" value=$tuple[lname]/>
                 <button name="update" type="submit"></button>
                 </form></br>/n"
            }

            //echo "<br/>";
            //echo "$_GET[passenger_ssn]";


            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>

</p>
</body>
</html>