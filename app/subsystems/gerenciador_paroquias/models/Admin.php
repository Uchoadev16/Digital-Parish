<?php

require_once(__DIR__ . "/SelectMain.php");

require_once('../src/PHPMailer.php');
require_once('../src/SMTP.php');
require_once('../src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class User extends SelectMain
{
    public function __construct()
    {
        parent::__construct();
    }

    public function CadastrarParoquia(
        string $nome_paroquia, 
        string $localizacao, 
        string $telefone, 
        string $logo,
        string $secretario_nome,
        string $secretario_email,
        string $secretario_cpf,
        string $paroco_nome,
        string $paroco_email,
        string $paroco_cpf,
        string $vigario_nome,
        string $vigario_email,
        string $vigario_cpf
    ): int
    {
        $sql = "INSERT INTO {$this->tables['pari']} (nome_paroquia, localizacao, telefone, logo) VALUES (:nome_paroquia, :localizacao, :telefone, :logo)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome_paroquia', $nome_paroquia);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':logo', $logo);
        $stmt->execute();
        if (!$stmt->execute()) {
            return 2;
        }
        

        $stmt = $this->connection->query("INSERT INTO {$this->tables['prof']} VALUES (null, 'Secretário', $id_paroquia)");
       

        $sql = "INSERT INTO {$this->tables['users']} (nome_usuario, email, cpf, senha, fk_perfis_id, fk_paroquias_id) VALUES (:nome_usuario, :email, :cpf, :senha, :fk_perfis_id, :fk_paroquias_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome_usuario', $secretario_nome);
        $stmt->bindParam(':email', $secretario_email);
        $stmt->bindParam(':cpf', $secretario_cpf);
        $stmt->bindParam(':fk_perfis_id', 2);
        return 1;
    }
}
