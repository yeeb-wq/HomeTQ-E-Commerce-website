<?php
session_start();

$pageName="Logout";   

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";  
echo "<title>".$pageName."</title>";  
echo "<body>"; 

include ("headfile.html");  
include ("detectlogin.php");

echo "<h4>".$pageName."</h4>";

// Check if user was logged in
if (isset($_SESSION["userId"]))
{
    echo "<p class='updateInfo'>";

    echo "Thank you, " . $_SESSION["userFName"] . " " . $_SESSION["userSName"] . ".<br>";
    echo "You have been successfully logged out.";

    echo "</p>";

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}
else
{
    echo "<p class='updateInfo'>";
    echo "You are not currently logged in.";
    echo "</p>";
}

include("footfile.html");  
echo "</body>"; 
?>