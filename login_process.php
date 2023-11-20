<?php
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User('localhost', 'gptexchange', 'root', '314422ah');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $authenticatedUser = $user->authenticateUser($username, $password);

    if ($authenticatedUser) {
        $userId = $authenticatedUser['id']; // Assuming 'id' is the column in your users table that represents user ID

        // Set a cookie with the user ID
        setcookie('user_id', $userId, time() + 3600, '/'); // Adjust the expiration time as needed

        // Redirect to success.php with a login query parameter
        header("Location: success.php?login=success");
        exit();
    } else {
        echo 'Authentication failed!';
    }
} else {
    header("Location: login.php");
    exit();
}
?>
