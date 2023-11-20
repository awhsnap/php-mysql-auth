<?php

class User
{
    private $db;

    // Database connection
    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        // Create tables if they don't exist
        $this->createTables();
    }

    // Create tables if they don't exist
    private function createTables()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL,
                hashed_password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";

        try {
            $this->db->exec($query);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    // Register a new user
    public function registerUser($username, $password)
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Set default values for other fields
        $email = ''; // You can set this from the user's profile

        // Prepare and execute the SQL query
        $query = "INSERT INTO users (username, email, hashed_password) 
                  VALUES (:username, :email, :hashed_password)";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':hashed_password', $hashedPassword);

        // Execute the query
        if ($statement->execute()) {
            return true; // Registration successful
        } else {
            return false; // Registration failed
        }
    }

    // Authenticate a user
    public function authenticateUser($username, $password)
    {
        // Retrieve the user by username
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['hashed_password'])) {
            return $user; // Return the authenticated user data
        } else {
            return null; // Authentication failed
        }
    }

    // Example method to get the last inserted user ID
    public function getLastInsertedUserId()
    {
        return $this->db->lastInsertId();
    }

    // Update user profile
    public function updateUserProfile($userId, $newEmail)
    {
        $query = "UPDATE users SET email = :new_email WHERE id = :user_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':new_email', $newEmail);
        $statement->bindParam(':user_id', $userId);
        $statement->execute();
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = :user_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

?>
