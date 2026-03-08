<?php 
session_start();
include("db.php");
$pageName="smart basket";

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pageName."</title>";
echo "<body>";

include ("headfile.html");
include ("detectlogin.php");

echo "<h4>".$pageName."</h4>";

/* ---------------------------
   Task 02 + Task 03
----------------------------*/

// retrieve values safely
$newProdId = isset($_POST['h_prodid']) ? $_POST['h_prodid'] : "";
$requQuantity = isset($_POST['prod_quantity']) ? $_POST['prod_quantity'] : "";

if ($newProdId != "" && $requQuantity != "")
{
    echo "<p>Id of selected product ".$newProdId."</p>";
    echo "<p>Quantity of selected product ".$requQuantity."</p>";

    $_SESSION['basket'][$newProdId] = $requQuantity;

    echo "<p class='updateInfo'><b>1 item added</b></p>";
}
else
{
    echo "<p class='updateInfo'><b>Basket unchanged</b></p>";
}

/* ---------------------------
   Task 08 – Add REMOVE Logic
----------------------------*/

if (isset($_POST['remove_id']))
{
    $removeId = $_POST['remove_id'];

    // remove selected product from basket session
    unset($_SESSION['basket'][$removeId]);

    echo "<p class='updateInfo'><b>1 item removed from the basket</b></p>";
}


/* ---------------------------
   Task 04 – Display Basket
----------------------------*/

// create total variable
$total = 0;

// if basket session exists
if (isset($_SESSION['basket']))
{   //headers for the table
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Product Name</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Subtotal</th>";
    echo "<th>Remove</th>";
    echo "</tr>";

    // loop through basket session
    foreach ($_SESSION['basket'] as $key => $value)
    {
        // SQL query to retrieve product details
        $SQL = "SELECT * FROM Product WHERE prodId = '$key'";
        $exeSQL = mysqli_query($conn, $SQL);
        $arrayProd = mysqli_fetch_array($exeSQL);

        if ($arrayProd)
        {
            $prodName = $arrayProd['prodName'];
            $prodPrice = $arrayProd['prodPrice'];

            // calculate subtotal
            $subtotal = $prodPrice * $value;

            // add to total
            $total += $subtotal;

            // display row
            echo "<tr>";
            echo "<td>".$prodName."</td>";
            echo "<td>".$prodPrice."</td>";
            echo "<td>".$value."</td>";
            echo "<td>".$subtotal."</td>";
            
            // We must insert the Remove button BEFORE echo "</tr>";
            echo "<td>
            <form method='post' action='basket.php'>
            <input type='hidden' name='remove_id' value='".$key."'>
            <input type='submit' value='REMOVE'>
            </form>
            </td>";
            
            echo "</tr>";

            //For each product row, it creates:
            // A small form
            // Sends hidden product ID
            // Submits back to basket.php
            // Triggers remove logic
        }
    }

    echo "</table>";

    // display total
    echo "<h3>Total: ".$total."</h3>";
}
else
{
    echo "<p><b>Empty basket</b></p>";
}


// close database connection
mysqli_close($conn);

echo "<p><a href='clearbasket.php'>Clear Basket</a></p>"; //Add Clear Basket Link 

echo "<p><a href='signup.php'>Sign Up</a></p>"; //Add Signup & Login Anchors
echo "<p><a href='login.php'>Login</a></p>";

include("footfile.html");
echo "</body>";
?>