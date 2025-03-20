<?php
class Database {
    private $host = 'localhost'; // Remplace par ton hôte 
    private $db_name = 'gestion_clients'; // Nom de la base de données
    private $username = 'root'; // Ton identifiant MySQL
    private $password = ''; // Ton mot de passe MySQL
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
