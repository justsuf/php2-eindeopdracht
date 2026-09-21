<?php
class Project {
    protected $title;
    protected $description;
    protected $date;
    protected $category;
    public function __construct($title, $description, $date, $category) {
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->category = $category;
    }

    public function getTitle() {
        return $this->title;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getDate() {
        return $this->date;
    }
    public function getCategory() {
        return $this->category;
    }

    public function save(PDO $conn, $userId) {
        $stmt = $conn->prepare("INSERT INTO projecten (user_id, naam, beschrijving, status, project_datum) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $userId,
            $this->title,
            $this->description,
            $this->category,
            $this->date
        ]);
    }
    public function update(PDO $conn, $id, $userId) {
        $stmt = $conn->prepare("UPDATE projecten SET naam = ?, beschrijving = ?, status = ?, project_datum = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([
            $this->title,
            $this->description,
            $this->category,
            $this->date,
            $id,
            $userId
        ]);
    }
    public static function getById(PDO $conn, $id) {
        $stmt = $conn->prepare("SELECT id, user_id, naam AS title, beschrijving AS description, status AS category, project_datum AS date FROM projecten WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUsersId(PDO $conn, $userId) {
        $stmt = $conn->prepare(
            "SELECT id, user_id, naam, beschrijving, status, project_datum
             FROM projecten
             WHERE user_id = ?"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete(PDO $conn, $id, $userId) {
        $stmt = $conn->prepare("DELETE FROM projecten WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}
?>