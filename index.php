<?php
require_once 'User.php';

// Assuming you have an instance of the User class
$user = new User('localhost', 'gptexchange', 'root', '314422ah');

// Check if the user is logged in (cookie exists)
if (isset($_COOKIE['user_id'])) {
    $userId = $_COOKIE['user_id'];

    // Fetch user details based on the user ID
    $userProfile = $user->getUserById($userId);

    if ($userProfile) {
        // Display user information
        $username = $userProfile['username'];
        $email = $userProfile['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation bar (you can include it if needed) -->
    <!-- ... (your navigation bar code) -->

    <!-- User Profile -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Profile</h5>

                <!-- Display user information -->
                <p>Username: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>

                <!-- Add other user-related content as needed -->

            </div>
        </div>
    </div>


</body>

</html>

<?php
    } else {
        // Handle the case where user profile retrieval failed
        echo 'Error fetching user profile.';
    }
} else {
    // User is not logged in, redirect to login.php
    header("Location: login.php");
    exit();
}
?>
