
<?php
session_start();
$pageName="login";                 //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 

echo "
<form method='post' action='login_process.php'>
<table>
<tr>
<td>Email:</td>
<td><input type='text' name='login_email'></td>
</tr>

<tr>
<td>Password:</td>
<td><input type='password' name='login_pwd'></td>
</tr>

<tr>
<td colspan='2'>
<input type='submit' value='Login'>
</td>
</tr>
</table>
</form>
";
 
 
include("footfile.html");                   //include head layout 
echo "</body>"; 
?> 