<?php

require_once(__DIR__ . "/../config/Connect.php");
class SelectMain extends Connect
{
    protected array $tables;

    public function __construct()
    {
        $this->getConnection();
        $this->tables = require(__DIR__ . "/../../.env/tables.php");
    }

    public function selectDadosUsuario(int $userId): array
    {
        $sql = "SELECT * FROM {$this->tables['users']} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectParoquiaUsuario(int $userId): array
    {
        $sql =
            "SELECT p.*, u.* FROM {$this->tables['pari']} p
        inner join {$this->tables['users']} u on p.id = u.fk_paroquias_id 
        WHERE u.id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectProblemasUsers(int $userId): array
    {
        $sql = "SELECT * FROM {$this->tables['prob']} WHERE fk_user_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
