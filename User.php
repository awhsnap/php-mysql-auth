<?php

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->db->createTables(); // Create tables if they don't exist
    }

    public function registerUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = '';

        $query = "INSERT INTO users (username, email, hashed_password) 
                  VALUES (:username, :email, :hashed_password)";

        $params = [
            ':username' => $username,
            ':email' => $email,
            ':hashed_password' => $hashedPassword
        ];

        return $this->db->executeQuery($query, $params);
    }

    public function authenticateUser($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $user = $this->db->fetch($query, $params);

        if ($user && password_verify($password, $user['hashed_password'])) {
            return $user;
        } else {
            return null;
        }
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = :user_id";
        $params = [':user_id' => $userId];
        return $this->db->fetch($query, $params);
    }

    // Other methods...

}

?>
