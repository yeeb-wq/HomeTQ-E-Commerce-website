<?php
session_start();
include("db.php");
$pageName="login outcome";

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pageName."</title>";
echo "<body>";

include("headfile.html");

echo "<h4>".$pageName."</h4>";

// retrieve form data
$email = isset($_POST['login_email']) ? $_POST['login_email'] : "";
$password = isset($_POST['login_pwd']) ? $_POST['login_pwd'] : "";

// check empty fields
if (empty($email) || empty($password))
{
    echo "<p><b>Login failed</b></p>";
    echo "<p><a href='login.php'>Back to Login</a></p>";
}
else
{
    // retrieve user record
    $SQL = "SELECT * FROM Users WHERE userEmail='$email'";
    $exeSQL = mysqli_query($conn, $SQL);
    $nbrecs = mysqli_num_rows($exeSQL);

    if ($nbrecs == 0)
    {
        echo "<p><b>Login failed</b></p>";
        echo "<p><a href='login.php'>Back to Login</a></p>";
    }
    else
    {
        $arrayU = mysqli_fetch_array($exeSQL);

        // check password
        if ($arrayU['userPassword'] != $password)
        {
            echo "<p><b>Login failed</b></p>";
            echo "<p><a href='login.php'>Back to Login</a></p>";
        }
        else
        {
            echo "<p><b>Login success</b></p>";

            // store session variables
            $_SESSION['userId'] = $arrayU['userId'];
            $_SESSION['userFName'] = $arrayU['userFName'];
            $_SESSION['userSName'] = $arrayU['userSName'];
            $_SESSION['userType'] = trim($arrayU['userType']);

            echo "<p>Welcome ".$arrayU['userFName']." ".$arrayU['userSName']."</p>";

            // FIXED USER TYPE CHECK
            $userType = trim($arrayU['userType']);

            if ($userType == 'c')
            {
                echo "<p>You are logged in as Customer</p>";
                echo "<p>Continue shopping</p>";
            }
            elseif ($userType == 'A')
            {
                echo "<p>You are logged in as Admin</p>";
                echo "<p>Access index & dashboard</p>";
            }
            else
            {
                echo "<p>User type unknown</p>";
            }

            echo "<p><a href='index.php'>Go to Home</a></p>";
        }
    }
}

mysqli_close($conn);

include("footfile.html");
echo "</body>";
?>