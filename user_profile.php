<?php
require_once 'User.php';

// Function to print user profile information
function printUserProfile($userProfile) {
    $username = $userProfile['username'];
    $email = $userProfile['email'];


    echo <<<HTML
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <p><strong>Username:</strong> $username</p>
                <p><strong>Email:</strong> $email</p>
            </div>
        </div>
HTML;
}

// Function to print the profile update form
function printProfileUpdateForm() {
    echo <<<HTML
        <form action="update_profile.php" method="post">
            <div class="form-group">
                <label for="newEmail">New Email:</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter new email">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
HTML;
}

// Function to print the page footer
function printPageFooter() {
    echo <<<HTML
        <!-- Include Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
HTML;
}

// Assuming you have instances of User and Transaction classes
$user = new User('localhost', 'gptexchange', 'root', '314422ah');
// Check if the user is logged in (cookie exists)
if (isset($_COOKIE['user_id'])) {
    $userId = $_COOKIE['user_id'];

    // Fetch user details based on the user ID
    $userProfile = $user->getUserById($userId);

    if ($userProfile) {
     

        // HTML document structure
        echo <<<HTML
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
HTML;

        // Navigation bar (you can include it if needed)
        // ... (your navigation bar code)

        // 2-column layout
        echo <<<HTML
            <div class="container mt-4">
                <div class="row">
HTML;

        // Left column for user information
        echo '<div class="col-md-3">';
        printUserProfile($userProfile);
        echo '</div>';

        // Right column for exchange content
        echo '<div class="col-md-9">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Exchange Content</h5>';

        // Profile Update Form
        printProfileUpdateForm();


        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Closing tags
        echo '</div>';
        echo '</div>';
        printPageFooter();
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
