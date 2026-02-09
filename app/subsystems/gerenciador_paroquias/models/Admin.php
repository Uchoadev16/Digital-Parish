<?php

require_once(__DIR__ . "/SelectMain.php");


class Admin extends SelectMain
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
        array $logo,
        string $secretario_nome,
        string $secretario_email,
        string $secretario_cpf,
        string $paroco_nome,
        string $paroco_email,
        string $paroco_cpf,
    ): int {

        $stmt_check_pari = $this->connection->prepare("SELECT * FROM {$this->tables['pari']} WHERE cnpj = :cnpj");
        $stmt_check_pari->bindParam(':cnpj', $cnpj);
        if (!$stmt_check_pari->execute()) {
            return 2;
        }
        if ($stmt_check_pari->rowCount() > 0) {
            return 3;
        }

        // Verificar se o arquivo foi enviado
        if (!isset($logo['tmp_name']) || empty($logo['tmp_name'])) {
            return 8;
        }

        // Verificar se houve erro no upload
        if ($logo['error'] !== UPLOAD_ERR_OK) {
            return 4;
        }

        // Verificar tipo de foto
        $tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($logo['type'], $tiposPermitidos)) {
            return 5;
        }

        // Verificar tamanho (máximo 5MB)
        if ($logo['size'] > 5 * 1024 * 1024) {
            return 6;
        }

        $sql = "INSERT INTO {$this->tables['pari']} VALUES (null, :nome_paroquia, :localizacao, :cnpj, :logo, :telefone)";
        $stmt_insert_pari = $this->connection->prepare($sql);
        $stmt_insert_pari->bindParam(':nome_paroquia', $nome_paroquia);
        $stmt_insert_pari->bindParam(':localizacao', $localizacao);
        $stmt_insert_pari->bindParam(':cnpj', $cnpj);
        $stmt_insert_pari->bindParam(':logo', $logo['name']);
        $stmt_insert_pari->bindParam(':telefone', $telefone);
        if (!$stmt_insert_pari->execute()) {
            return 2;
        }

        $stmt_by_id = $this->connection->prepare("SELECT * FROM {$this->tables['pari']} WHERE cnpj = :cnpj");
        $stmt_by_id->bindParam(':cnpj', $cnpj);
        if (!$stmt_by_id->execute()) {
            return 2;
        }
        $id_pari = $stmt_by_id->fetch(PDO::FETCH_ASSOC);

        $pastaDestino = __DIR__ . '/../../../main/assets/logo_paroquia/';
        // Gerar nome único para o foto
        $extensao = pathinfo($logo['name'], PATHINFO_EXTENSION);
        $nomeArquivo = 'logo_' . $id_pari['id'] . '_' . time() . '.' . $extensao;
        $caminhoCompleto = $pastaDestino . $nomeArquivo;
        // Mover foto
        if (move_uploaded_file($logo['tmp_name'], $caminhoCompleto)) {
            // Atualizar banco de dados
            $stmt = $this->connection->prepare("UPDATE {$this->tables['pari']} SET logo = :logo WHERE id = :id");
            $stmt->bindValue(':logo', $nomeArquivo);
            $stmt->bindValue(':id', $id_pari['id']);

            if (!$stmt->execute()) {
                // Se falhou no banco, remover foto
                unlink($caminhoCompleto);
                return 2;
            }
        } else {
            return 7;
        }

        $stmt_insert_prof = $this->connection->query("INSERT INTO {$this->tables['prof']} VALUES (null, 'SECRETÁRIO(A)', {$id_pari['id']})");
        $stmt_insert_prof = $this->connection->query("INSERT INTO {$this->tables['prof']} VALUES (null, 'PÁROCO', {$id_pari['id']})");

        $stmt_id_prof_sec = $this->connection->prepare("SELECT * FROM {$this->tables['prof']} WHERE nome_perfil = :perfil AND fk_paroquias_id = :id");
        $stmt_id_prof_sec->bindValue(':id', $id_pari['id']);
        $stmt_id_prof_sec->bindValue(':perfil', 'SECRETÁRIO(A)');
        if (!$stmt_id_prof_sec->execute()) {
            return 2;
        }
        $id_prof_sec = $stmt_id_prof_sec->fetch(PDO::FETCH_ASSOC);

        $stmt_id_prof_pad = $this->connection->prepare("SELECT * FROM {$this->tables['prof']} WHERE nome_perfil = :perfil AND fk_paroquias_id = :id");
        $stmt_id_prof_pad->bindParam(':id', $id_pari['id']);
        $stmt_id_prof_pad->bindValue(':perfil', 'PÁROCO');
        if (!$stmt_id_prof_pad->execute()) {
            return 2;
        }
        $id_prof_pad = $stmt_id_prof_pad->fetch(PDO::FETCH_ASSOC);

        $sql = "INSERT INTO {$this->tables['users']} (nome_usuario, email, cpf, fk_perfis_id, fk_paroquias_id) VALUES (:nome_usuario, :email, :cpf, :fk_perfis_id, :fk_paroquias_id)";
        $stmt_insert_sec = $this->connection->prepare($sql);
        $stmt_insert_sec->bindParam(':nome_usuario', $secretario_nome);
        $stmt_insert_sec->bindParam(':email', $secretario_email);
        $stmt_insert_sec->bindParam(':cpf', $secretario_cpf);
        $stmt_insert_sec->bindParam(':fk_perfis_id', $id_prof_sec['id']);
        $stmt_insert_sec->bindParam(':fk_paroquias_id', $id_pari['id']);
        if (!$stmt_insert_sec->execute()) {
            return 2;
        }

        $sql = "INSERT INTO {$this->tables['users']} (nome_usuario, email, cpf, fk_perfis_id, fk_paroquias_id) VALUES (:nome_usuario, :email, :cpf, :fk_perfis_id, :fk_paroquias_id)";
        $stmt_insert_pad = $this->connection->prepare($sql);
        $stmt_insert_pad->bindParam(':nome_usuario', $paroco_nome);
        $stmt_insert_pad->bindParam(':email', $paroco_email);
        $stmt_insert_pad->bindParam(':cpf', $paroco_cpf);
        $stmt_insert_pad->bindParam(':fk_perfis_id', $id_prof_pad['id']);
        $stmt_insert_pad->bindParam(':fk_paroquias_id', $id_pari['id']);
        if (!$stmt_insert_pad->execute()) {
            return 2;
        }

        return 1;
    }
}
