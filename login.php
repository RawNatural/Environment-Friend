<fieldset>
    <legend>Login User</legend>

    <form>
        <label for='UsernameLogin'>Username</label>
        <input type='text' name='UsernameLogin' id='UsernameLogin' class='login-field' required>
        <label for='PasswordLogin'>Password</label>
        <input type='password' name='PasswordLogin' id='PasswordLogin' class='login-field' required></p>

        <input type="submit" name="loginUser" id="loginUser" value="Login">

    </form>
</fieldset>

<?php

if (isset($_GET['UsernameLogin'])){



    include("htaccess/databaseconnect.php");


    $username = $_GET['UsernameLogin'];
    $password = $_GET['PasswordLogin'];




    $stmt = $conn->prepare("SELECT * FROM Users
     WHERE username = ? AND password = SHA('$password');");
    $stmt->bind_param('s', $username);
    // Perform query to see how many users there are
    $stmt->execute();
    $result = $stmt->get_result();
    print($result->num_rows);
    if ($conn->error) {
        echo "<p>ERROR: Database not connecting</p>\n";
    } else {
        if($result->num_rows === 0) {
            print("Incorrect Username AND/OR Password");
        } else {
            echo "<br> login";
            $_SESSION['authenticatedUser'] = $username;
            $row = $result->fetch_assoc();
            $role = $row['role'];
            $_SESSION['role'] = $role;
            if (isset($_SESSION['lastPage'])){
                $lastPage = $_SESSION['lastPage'];
                header('Location: $lastPage');
            } else {
                header("Location: shop.php");
            }
        }
    }

    mysqli_close($conn);
}