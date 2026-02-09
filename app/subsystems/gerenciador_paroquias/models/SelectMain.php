<?php
require_once(__DIR__ . "/Sessions.php");
$session = new Sessions();
if (isset($_GET['logout'])) {
  $session->logout();
}
require_once(__DIR__ . "/../config/Connect.php");
class SelectMain extends Connect
{
    protected array $tables;

    public function __construct()
    {
        $this->getConnection();
        $this->tables = require(__DIR__ . "/../../../.env/tables.php");
    }

    public function selectParoquias(): array
    {
        $sql = "SELECT * FROM {$this->tables['pari']}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectParoquia(int $id): array
    {
        $sql = "SELECT * FROM {$this->tables['pari']} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
