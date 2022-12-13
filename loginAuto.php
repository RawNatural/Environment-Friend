<?php
if (session_id() === "") {
    session_start();
}
include("htaccess/databaseconnect.php");

$username = $_POST['loginUser'];
$password = $_POST['loginPassword'];


$stmt = $conn->prepare("SELECT * FROM Users
 WHERE username = ? AND password = SHA('$password');");
$stmt->bind_param('s', $username);
/**$query = "SELECT * FROM Users
WHERE username = '$username'
AND password = SHA('$password');";*/
// Perform query to see how many users there are
$stmt->execute();
$result = $stmt->get_result();
if ($conn->error) {
    echo "<p>ERROR: Could not update database</p>\n";
} else {
    if($result->num_rows === 0) {
        print("Incorrect Username AND/OR Password");
    } else {
        echo "<br> login";
        $_SESSION['authenticatedUser'] = $username;
        print_r($result);
        $row = $result->fetch_assoc();
        print_r($result);
        $role = $row['role'];
        $_SESSION['role'] = $role;
        print("hello");
    }
}

mysqli_close($conn);


if (isset($_SESSION['lastPage'])){
    $lastPage = $_SESSION['lastPage'];
    header("Location: $lastPage");
    exit;
} else {
    header('Location: index.php');
    exit;
}