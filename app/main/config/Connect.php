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

                $this->setHost($config['local']['paroquias']['host']);
                $this->setDatabase($config['local']['paroquias']['database']);
                $this->setUser($config['local']['paroquias']['user']);
                $this->setPassword($config['local']['paroquias']['password']);

                $this->connection = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getDatabase() . ';charset=utf8', $this->getUser(), $this->getPassword());
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Se falhar, tentar o banco da hospedagem


                $this->setHost($config['hospedagem']['paroquias']['host']);
                $this->setDatabase($config['hospedagem']['paroquias']['database']);
                $this->setUser($config['hospedagem']['paroquias']['user']);
                $this->setPassword($config['hospedagem']['paroquias']['password']);

                $this->connection = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getDatabase() . ';charset=utf8', $this->getUser(), $this->getPassword());
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

    protected function getHost()
    {
        return $this->host;
    }

    private function setHost($host)
    {
        $this->host = $host;
    }

    protected function getDatabase()
    {
        return $this->database;
    }

    private function setDatabase($database)
    {
        $this->database = $database;
    }

    protected function getUser()
    {
        return $this->user;
    }

    private function setUser($user)
    {
        $this->user = $user;
    }

    protected function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        $this->password = $password;
    }
}
