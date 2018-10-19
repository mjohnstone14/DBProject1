<?php
$first_name = $_POST["first_name"];
$m_name = $_POST["m_name"];
$last_name = $_POST["last_name"];
$ssn = $_POST["SSN"];

if(empty($first_name)) {
    header('Location: passengerForm.html');
    exit;
} else if(empty($last_name)) {
    header('Location: passengerForm.html');
    exit;
} else if(empty($ssn)) {
    header('Location: passengerForm.html');
    exit;
} else {
    echo $first_name;
}

?>