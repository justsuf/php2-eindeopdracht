<?php
class User {
    private $username;
    private $email;
    private $password;
    private $role;
    public function __construct($username, $email, $password, $role = 'student') {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = $role;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }

    public function register(PDO $conn) {
        // Controleer eerst of het e-mailadres al in gebruik is.
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        if ($stmt->rowCount() > 0) {
            return false;
        }
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $this->username,
            $this->email,
            $this->password,
            $this->role
        ]);
    }

    public static function login(PDO $conn, $email, $password) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Geef alleen een gebruiker terug wanneer het wachtwoord geldig is.
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>