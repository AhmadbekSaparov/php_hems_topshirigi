<?php
require_once 'Db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }


    public function create($name, $email) {
        $sql = "INSERT INTO user (name, email, created_at) VALUES (:name, :email, NOW())";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email
        ]);
        return $this->db->pdo->lastInsertId(); 
    }


    public function getAll() {
        $sql = "SELECT * FROM user ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id) {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email) {
        $sql = "UPDATE user SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email
        ]);
        return $stmt->rowCount(); 
    }

    
    public function delete($id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }
}
?>