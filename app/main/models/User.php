<?php

require_once(__DIR__ . "/SelectMain.php");
class User extends SelectMain
{
    public function __construct()
    {
        parent::__construct();
    }
    public function PreCadastro(string $email, string $cpf): int
    {
        try {
            $stmt_check = $this->connection->prepare("SELECT * FROM {$this->tables['users']} WHERE email = :email AND cpf = :cpf AND senha = NULL");
            $stmt_check->bindParam(":email", $email);
            $stmt_check->bindParam(":cpf", $cpf);
            if (!$stmt_check->execute()) {
                return 2;
            }

            if ($stmt_check->rowCount() === 0) {
                return 3;
            }
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['email'] = $email;
            $_SESSION['cpf'] = $cpf;

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function PrimeiroAcesso(string $cpf, string $email, string $senha): int
    {
        try {
            $stmt_check = $this->connection->prepare("SELECT * FROM {$this->tables['users']} WHERE email = :email AND cpf = :cpf AND senha = NULL");
            $stmt_check->bindParam(":email", $email);
            $stmt_check->bindParam(":cpf", $cpf);
            if (!$stmt_check->execute()) {
                return 2;
            }

            if ($stmt_check->rowCount() === 0) {
                return 3;
            }

            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt_cadastrar = $this->connection->prepare("UPDATE {$this->tables['users']} SET senha = :senha WHERE email = :email AND cpf = :cpf");
            $stmt_check->bindParam(":email", $email);
            $stmt_check->bindParam(":cpf", $cpf);
            if (!$stmt_check->execute()) {
                return 2;
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function login(string $email, string $senha)
    {

        $stmt_check = $this->connection->prepare(
            "SELECT u.*, p.*, pe.*, com.* FROM {$this->tables['users']} u
            INNER JOIN {$this->tables['pari']} p ON u.fk_paroquias_id = p.id
            INNER JOIN {$this->tables['prof']} p ON u.fk_perfis_id = pe.id
            INNER JOIN {$this->tables['comm']} p ON u.fk_comunidades_id = com.id
            WHERE email = :email
            "
        );
        $stmt_check->bindParam(":email", $email);
        if (! $stmt_check->execute()) {
            return 2;
        }
        $user = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($stmt_check->rowCount() > 0) {
            if (password_verify($senha, $user['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $stmt_check = $this->connection->prepare(
                    "SELECT t.tipo, s.nome FROM permissoes p 
                    INNER JOIN  tipos_usuarios t ON t.id = p.id_tipos_usuarios 
                    INNER JOIN  sistemas s ON s.id = p.id_sistemas 
                    INNER JOIN  usuarios u ON u.id = p.id_usuarios 
                    WHERE p.id_usuarios = :id"
                );

                $stmt_check->bindValue(':id', $user['id']);
                $stmt_check->execute();

                $dados = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
                foreach ($dados as $dado) {

                    $_SESSION[$dado['tipo']] = $dado['tipo'];
                    $_SESSION[$dado['nome']] = $dado['nome'];
                }

                $_SESSION['id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['setor'] = $user['setor'];
                $_SESSION['foto_perfil'] = $user['foto_perfil'];
                return 1;
            } else {
                return 4;
            }
        }
    }
}
