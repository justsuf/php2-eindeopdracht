<?php
class UserProfile {
    private $userId;
    private $bio;
    private $profileImage;
    private $website;
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function createProfile($userId, $bio, $profileImage, $website) {
        $this->userId = $userId;
        $this->bio = $bio;
        $this->profileImage = $profileImage;
        $this->website = $website;
        $stmt = $this->db->prepare(
            "INSERT INTO user_profiles (user_id, bio, profileImage, website) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $this->userId,
            $this->bio,
            $this->profileImage,
            $this->website
        ]);
    }
}
