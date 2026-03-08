
<?php 
session_start();
$pageName="Clear Smart Basket";                //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");   
include ("detectlogin.php");               //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 
unset($_SESSION['basket']);                 //This line deletes the entire basket from memory. 
      
//display random text 
echo "<p class='updateInfo'><b>Your basket has been cleared</b></p>";  // Display confirmation
 
include("footfile.html");                   //include head layout 
echo "</body>"; 

//what to test: 

//Add 2 products
//Click Smart Basket → see items
//Click Clear Basket
//See "Your basket has been cleared"
//Go back to Smart Basket → should show Empty Basket
?> 


