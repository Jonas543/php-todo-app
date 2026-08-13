<?php

class User
{
    private $conn;
    private $username;
    private $email;
    private $password;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function setUsername($username)
    {
        if (empty($username)) {
            throw new Exception("Username cannot be empty.");
        }

        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("Email cannot be empty.");
        }

        if (!str_ends_with($email, "@student.thomasmore.be")) {
            throw new Exception(
                "Email must end with @student.thomasmore.be."
            );
        }

        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        if (strlen($password) < 5) {
            throw new Exception(
                "Password must be at least 5 characters long."
            );
        }

        $this->password = $password;
    }

    public function register()
    {
        $hashedPassword = password_hash(
            $this->password,
            PASSWORD_DEFAULT
        );

        $statement = $this->conn->prepare(
            "INSERT INTO users (username, email, password)
             VALUES (:username, :email, :password)"
        );

        return $statement->execute([
            "username" => $this->username,
            "email" => $this->email,
            "password" => $hashedPassword
        ]);
    }

    public function login($email, $password)
    {
        $statement = $this->conn->prepare(
            "SELECT * FROM users WHERE email = :email"
        );

        $statement->execute([
            "email" => $email
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception(
                "Invalid email or password."
            );
        }

        if (!password_verify($password, $user["password"])) {
            throw new Exception(
                "Invalid email or password."
            );
        }

        return $user;
    }
}