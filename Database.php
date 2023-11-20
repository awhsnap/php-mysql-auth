<?php

class Database
{
    private $db;

    public function __construct()
    {
        $envFilePath = __DIR__ . '/.env';

        // Check if .env file exists
        if (file_exists($envFilePath)) {
            $envContent = file_get_contents($envFilePath);

            // Parse lines and set environment variables
            $lines = explode("\n", $envContent);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    $_ENV[$key] = $value;
                }
            }
        }

        // Use environment variables to establish the database connection
        $host = $_ENV['DB_HOST'] ?? '';
        $dbname = $_ENV['DB_NAME'] ?? '';
        $username = $_ENV['DB_USER'] ?? '';
        $password = $_ENV['DB_PASSWORD'] ?? '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function createTables()
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

    public function executeQuery($query, $params = [])
    {
        $statement = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $statement->bindParam($key, $value);
        }

        return $statement->execute();
    }

    public function fetch($query, $params = [])
    {
        $statement = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $statement->bindParam($key, $value);
        }

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
