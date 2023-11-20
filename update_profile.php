<?php
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in (cookie exists)
    if (isset($_COOKIE['user_id'])) {
        $userId = $_COOKIE['user_id'];

        // Assuming you have a User class instance
        $user = new User('localhost', 'gptexchange', 'root', '314422ah');

        // Fetch user details based on the user ID
        $userProfile = $user->getUserById($userId);

        if ($userProfile) {
            // Get new email and idle balance from the form submission
            $newEmail = $_POST['newEmail'];
            $newIdleBalance = $_POST['newIdleBalance'];

            // Update user profile
            $user->updateUserProfile($userId, $newEmail, $newIdleBalance);

            // Redirect to index.php with a success message
            header("Location: index.php?profile_update=success");
            exit();
        } else {
            // Handle the case where user profile retrieval failed
            echo 'Error fetching user profile.';
        }
    } else {
        // User is not logged in, redirect to login.php
        header("Location: login.php");
        exit();
    }
} else {
// After updating the user profile in update_profile.php
header("Location: user_profile.php?profile_update=success");
exit();
}
?>
