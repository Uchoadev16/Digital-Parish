<?php
class Connect
{
    protected $connection = null;
    private String $host;
    private String $database;
    private String $user;
    private String $password;


    private function __construct()
    {
        $this->getConnection();
    }

    protected function getConnection()
    {
        try {
            $config = require(__DIR__ . "/../../.env/config.php");

            // Tentar primeiro o banco local
            try {

                $this->host = $config['local']['paroquias']['host'];
                $this->database = $config['local']['paroquias']['database'];
                $this->user = $config['local']['paroquias']['user'];
                $this->password = $config['local']['paroquias']['password'];

                $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->user, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Se falhar, tentar o banco da hospedagem

                $this->host = $config['hospedagem']['paroquias']['host'];
                $this->database = $config['hospedagem']['paroquias']['database'];
                $this->user = $config['hospedagem']['paroquias']['user'];
                $this->password = $config['hospedagem']['paroquias']['password'];

                $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->user, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {

            error_log("Erro de conexão com banco: " . $e->getMessage());
            $this->connection = null;
            header('location:../views/windows/desconectado.php');
            exit();
        }
    }
}
