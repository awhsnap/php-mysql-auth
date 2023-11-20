<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Login</h1>

        <!-- Your login form goes here -->
        <form action="login_process.php" method="post">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md
                    focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md
                    focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600
                    focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
