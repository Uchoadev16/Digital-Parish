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
        string $cnpj,
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
        $stmt_check_pari = $this->connection->prepare("SELECT * FROM {$this->tables['pari']} WHERE cnpj = :cnpj");
        $stmt_check_pari->bindParam(':cnpj', $cnpj);
        if (!$stmt_check_pari->execute()) {
            return 2;
        }
        if($stmt_check_pari->rowCount() > 0){
            return 3;
        }

        $sql = "INSERT INTO {$this->tables['pari']} (nome_paroquia, localizacao, telefone, logo) VALUES (:nome_paroquia, :localizacao, :telefone, :logo)";
        $stmt_insert_pari = $this->connection->prepare($sql);
        $stmt_insert_pari->bindParam(':nome_paroquia', $nome_paroquia);
        $stmt_insert_pari->bindParam(':localizacao', $localizacao);
        $stmt_insert_pari->bindParam(':telefone', $telefone);
        $stmt_insert_pari->bindParam(':logo', $logo);
        $stmt_insert_pari->execute();
        if (!$stmt_insert_pari->execute()) {
            return 2;
        }
 
        $stmt_by_id = $this->connection->prepare("SELECT * FROM {$this->tables['pari']} WHERE cnpj = :cnpj");
        $stmt_by_id->bindParam(':cnpj', $cnpj);
        if (!$stmt_by_id->execute()) {
            return 2;
        }
        $id_pari = $stmt_by_id->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->connection->query("INSERT INTO {$this->tables['prof']} VALUES (null, 'Secretário', {$id_pari['id']})");
        $stmt = $this->connection->query("INSERT INTO {$this->tables['prof']} VALUES (null, 'Padre', {$id_pari['id']})");


        $sql = "INSERT INTO {$this->tables['users']} (nome_usuario, email, cpf, senha, fk_perfis_id, fk_paroquias_id) VALUES (:nome_usuario, :email, :cpf, :senha, :fk_perfis_id, :fk_paroquias_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome_usuario', $secretario_nome);
        $stmt->bindParam(':email', $secretario_email);
        $stmt->bindParam(':cpf', $secretario_cpf);
        $stmt->bindParam(':fk_perfis_id', 2);
        return 1;
    }
}
