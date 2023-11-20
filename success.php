<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-md shadow-md text-center">
        <?php
        // Check if registration or login success
        if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
            echo '<h1 class="text-2xl font-semibold mb-4">Registration Successful</h1>';
            echo '<p class="mb-4">Congratulations! Your registration was successful.</p>';
        } elseif (isset($_GET['login']) && $_GET['login'] === 'success') {
            echo '<h1 class="text-2xl font-semibold mb-4">Login Successful</h1>';
            echo '<p class="mb-4">Welcome back! You have successfully logged in.</p>';
        } else {
            // Default message (handle unexpected cases)
            echo '<h1 class="text-2xl font-semibold mb-4">Success</h1>';
            echo '<p class="mb-4">Operation successful.</p>';
        }

        // Display a random quote from quotes.json
        $quotesJson = file_get_contents('quotes.json');
        $quotesArray = json_decode($quotesJson, true);

        // Get a random quote
        $randomIndex = array_rand($quotesArray);
        $randomQuote = $quotesArray[$randomIndex]['quote'];
        ?>

        <blockquote class="text-gray-600 italic">
            <?php echo $randomQuote; ?>
        </blockquote>

        <!-- Redirect to index.php after a few seconds -->
        <script>
            setTimeout(function () {
                window.location.href = 'index.php';
            }, 5000); // Redirect after 5 seconds
        </script>
    </div>
</body>

</html>
