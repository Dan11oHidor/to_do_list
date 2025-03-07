<?php 

// conexão com o banco de dados
class Database {
    private string $host;
    private string $database;
    private string $user;
    private string $password;

    private PDO $pdo;
    public function __construct() {
        $this->host = 'localhost';
        $this->database = 'to_do_list';
        $this->user = 'root';
        $this->password = '';

        $this->connect();
    }

    private function connect() {
        try {
            $str = sprintf('mysql:host=%s;dbname=%s', $this->host, $this->database);
    
            $this->pdo = new PDO($str, $this->user, $this->password);
    
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            print_r($ex->getMessage());
            die();
        }
    }

    public function query(string $str, array $params)
    {
        $stmt = $this->pdo->prepare($str);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPdo(): PDO {
        return $this->pdo;
    }
}