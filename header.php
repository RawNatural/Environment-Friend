
<?php
if (session_id() === "") {
    session_start();
}
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];


?>

<!DOCTYPE html>

<html lang="en">

<head>
        <title>EnvironmentFriend</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    <?php
foreach ($scriptList as $script) {
    echo "<script src='$script'></script>";
}



?>
</head>
<body>


        <header>
            <img style="height: 55px; width: 55px;" src="images/logo.png">
            <h1>Environment Friend</h1>

            <?php include("nav.php");?>


            <?php if (isset($_SESSION['authenticatedUser'])) { ?>
            <div id="user">

                <p>Welcome, <?php $username = $_SESSION['authenticatedUser']; $role = $_SESSION['role'];  echo"$username";?><span id="logoutUser"></span></p>
                <form id="logoutForm" action="logout.php" method="post">
                    <input type="submit" id="logoutSubmit" value="Logout">
                </form>

            </div>

            <?php } else { ?>
                <div id="user">
                    <form id="loginForm" action="loginAuto.php" method="post">
                        <label for="loginUser">Username: </label>
                        <input type="text" name="loginUser" id="loginUser" required><br>
                        <label for="loginPassword">Password: </label>
                        <input type="password" name="loginPassword" id="loginPassword" required><br>
                        <input type="submit" id="loginSubmit" value="Login">
                    </form>
                    <a href="register.php"><button id="registerButton">Register</button></a>
                </div>


            <?php } ?>

            </header>