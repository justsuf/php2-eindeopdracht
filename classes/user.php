<?php
class User {
    private $username;
    private $email;
    private $password;
    private $role;
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function register($username, $email, $password) {
        $this->username = trim($username);
        $this->email = trim($email);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = 'student';
        if ($this->username === '' || $password === '' || !filter_var($this->email, FILTER_VALIDATE_EMAIL) || $this->password === false) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        if ($stmt->fetchColumn() !== false) {
            return false;
        }
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $this->username,
            $this->email,
            $this->password,
            $this->role
        ]);
    }
    public function login($email, $password) {
        $this->email = trim($email);
        $stmt = $this->db->prepare("SELECT user_id, username, email, password, role FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }
}
