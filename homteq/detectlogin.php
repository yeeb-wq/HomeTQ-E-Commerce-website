<?php

// check if user is logged in
if (isset($_SESSION["userId"])) 
{
    echo "<br><br>";

    // small member icon (you can change image name if needed)
    echo "<div style='text-align:right;'>";

    echo "<img src='member.png' alt='member' width='30'><br>";

    echo "<span class='memberDetails'>";

    echo $_SESSION["userFName"] . " " . $_SESSION["userSName"];

    echo " (" ;

    // show full user type instead of just C or A
    if ($_SESSION["userType"] == "c")
    {
        echo "Customer";
    }
    else
    {
        echo "Administrator";
    }

    echo ")";

    echo "</span>";

    echo "</div>";
}

?>