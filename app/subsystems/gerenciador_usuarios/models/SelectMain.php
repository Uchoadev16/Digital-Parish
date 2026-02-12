<?php

require_once(__DIR__ . "/../config/Connect.php");
class SelectMain extends Connect
{
    protected array $tables;

    public function __construct()
    {
        $this->getConnection();
        $this->tables = require(__DIR__ . "/../../../.env/tables.php");
    }

    
}
