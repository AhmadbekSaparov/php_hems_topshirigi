<?php
class Db {
    private $host = '127.0.0.1';
    private $dbname = 'ahmadbek_topshiriq1';  
    private $username = 'root';                
    private $password = '';                    
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Ulanishda xatolik: " . $e->getMessage());
        }
    }
}
?>