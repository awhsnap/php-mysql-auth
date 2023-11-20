<?php
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User('localhost', 'gptexchange', 'root', '314422ah');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->registerUser($username, $password)) {
        $userId = $user->getLastInsertedUserId(); // Example method, replace with actual method to get user ID

        // Set a cookie with the user ID
        setcookie('user_id', $userId, time() + 3600, '/'); // Adjust the expiration time as needed

        // Redirect to success.php with a registration query parameter
        header("Location: success.php?registration=success");
        exit();
    } else {
        echo 'Registration failed!';
    }
} else {
    header("Location: register.php");
    exit();
}
?>
