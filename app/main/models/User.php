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
    public function PreCadastro(string $email, string $cpf): int
    {
        try {
            $stmt_check = $this->connection->prepare(
                "SELECT * FROM {$this->tables['users']} 
                WHERE senha IS NULL AND email = :email AND cpf = :cpf"
            );

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
            $stmt_check = $this->connection->prepare("SELECT * FROM {$this->tables['users']} WHERE senha IS NULL AND email = :email AND cpf = :cpf");
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
            $stmt_cadastrar->bindParam(":senha", $hash);
            $stmt_cadastrar->bindParam(":email", $email);
            $stmt_cadastrar->bindParam(":cpf", $cpf);
            if (!$stmt_cadastrar->execute()) {
                return 2;
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function Login(string $email, string $senha): int
    {
        try {
            $stmt_check = $this->connection->prepare(
                "SELECT u.*, p.id AS id_paroquia, pe.id AS id_perfil FROM {$this->tables['users']} u
            INNER JOIN {$this->tables['pari']} p ON p.id = u.fk_paroquias_id
            INNER JOIN {$this->tables['prof']} pe ON pe.id = u.fk_perfis_id
            WHERE email = :email
            "
            );
            $stmt_check->bindParam(":email", $email);
            $stmt_check->execute();
            $user = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($senha, $user['senha'])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $stmt_permissoes = $this->connection->prepare(
                        "SELECT t.tipos_usuarios, s.nome_sistema, c.nome_comunidade FROM {$this->tables['perm']} p 
                    INNER JOIN  {$this->tables['type']} t ON t.id = p.fk_tipos_usuarios_id
                    INNER JOIN  {$this->tables['sys']} s ON s.id = p.fk_sistemas_id
                    INNER JOIN  {$this->tables['users']} u ON u.id = p.fk_usuarios_id
                    INNER JOIN  {$this->tables['comm']} c ON c.id = p.fk_usuarios_id
                    WHERE p.fk_usuarios_id = :id"
                    );
                    $stmt_permissoes->bindParam(':id', $user['id']);
                    if (!$stmt_permissoes->execute()) {
                        return 2;
                    }

                    $dados = $stmt_permissoes->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($dados as $dado) {

                        $_SESSION[$dado['tipos_usuarios']] = $dado['tipo_usuarios'];
                        $_SESSION[$dado['nome_sistema']] = $dado['nome_sistema'];
                        $_SESSION[$dado['nome_sistema'] . '_' . $dado['nome_comunidade']] = $dado['nome_sistema'] . '_' . $dado['nome_comunidade'];
                    }

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nome'] = $user['nome_usuario'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['cpf'] = $user['cpf'];
                    $_SESSION['foto_perfil'] = $user['foto_perfil'];
                    $_SESSION['paroquias_id'] = $user['fk_paroquias_id'];
                    $_SESSION['perfis_id'] = $user['id_perfil'];
                    $_SESSION['comunidades_id'] = $user['fk_comunidades_id'];
                    return 1;
                } else {
                    return 3;
                }
            } else {
                return 3;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function EsqueceuSenha(string $email): int
    {
        try {
            $stmt_check = $this->connection->prepare("SELECT * FROM {$this->tables['users']} WHERE email = :email");
            $stmt_check->bindParam(":email", $email);
            if (!$stmt_check->execute()) {
                return 2;
            }
            if ($stmt_check->rowCount() == 0) {
                return 3;
            }
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['email_recuperar_senha'] = $email;
            $_SESSION['codigo'] = random_int(100000, 999999);

            $tempo = time();
            if (time() - $tempo > 600) {

                session_unset();
                session_destroy();
                return 4;
            }

            $tempo = time();
            $dados = require(__DIR__ . '/../../../.env/config.php');
            $mail = new PHPMailer(true);
            try {

                $mail->SMTPDebug = 0;
                $mail->Debugoutput = function ($str, $level) {
                    error_log("PHPMailer Debug [$level]: $str"); // Redirecionar debug para error_log
                };
                $mail->isSMTP();
                $mail->Host = $dados['emails']['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $dados['emails']['email'];
                $mail->Password = $dados['emails']['senha'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $dados['emails']['porta'];

                // Destinatário e remetente
                $mail->setFrom($dados['emails']['email'], 'Paróquia Digital');
                $mail->addAddress($email);

                // Conteúdo do e-mail
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Recuperar Senha - Paróquia Digital';
                $mail->Body = '
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Recuperar Senha - Sistema Salaberga</title>
                <style>
                    body, table, td, a, p, h1, h2 {
                        margin: 0;
                        padding: 0;
                        font-family: "Inter", sans-serif;
                    }
                    img { border: none; max-width: 100%; height: auto; display: block; }
                    a { text-decoration: none; }
                    table { border-collapse: collapse; width: 100%; }
                    .email-container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #F8FAF9;
                        border-radius: 16px;
                        overflow: hidden;
                        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
                        padding: 20px;
                        text-align: center;
                        color: #FFFFFF;
                    }
                    .header img { margin: 0 auto; width: 80px; }
                    .header h1 { font-family: "Poppins", sans-serif; font-size: 24px; font-weight: 600; margin-top: 10px; color: #FFFFFF !important; }
                    /* Garantindo que o título seja branco em todos os dispositivos */
                    @media only screen and (max-width: 600px) {
                        .header h1 { color: #FFFFFF !important; }
                    }
                    .content { padding: 30px 20px; background-color: #FFFFFF; text-align: center; }
                    .content h2 { font-family: "Poppins", sans-serif; font-size: 20px; color: #1A3C34; margin-bottom: 15px; }
                    .content p { font-size: 16px; color: #374151; line-height: 1.5; margin-bottom: 20px; }
                    .code-box { display: inline-block; background-color: #E6F4EA; color: #005A24; font-size: 24px; font-weight: 600; padding: 15px 30px; border-radius: 8px; margin: 20px 0; letter-spacing: 2px; }
                    .btn { display: inline-block; background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%); color: #FFFFFF; font-family: "Poppins", sans-serif; font-size: 16px; font-weight: 600; padding: 12px 24px; border-radius: 8px; }
                    .btn:hover { background: linear-gradient(135deg, #1A3C34 0%, #005A24 100%); }
                    .footer { background-color: #F4F4F4; padding: 20px; text-align: center; font-size: 14px; color: #6B7280; }
                    .footer a { color: #FFA500; }
                    .footer a:hover { text-decoration: underline; }
                    @media only screen and (max-width: 600px) {
                        .email-container { width: 100%; border-radius: 0; }
                        .header h1 { font-size: 20px; }
                        .content h2 { font-size: 18px; }
                        .content p { font-size: 14px; }
                        .code-box { font-size: 20px; padding: 10px 20px; }
                        .btn { font-size: 14px; padding: 10px 20px; }
                    }
                </style>
            </head>
            <body>
                <table role="presentation" class="email-container">
                    <tr>
                        <td class="header">
                            <img src="https://i.postimg.cc/0N0dsxrM/Bras-o-do-Cear-svg-removebg-preview.png" alt="Logo Salaberga">                         </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <h2>Recuperação de Senha</h2>
                            <p>Olá, você solicitou a recuperação de senha para o Sistema Salaberga. Use o código abaixo para redefinir sua senha:</p>
                            <div class="code-box">' . htmlspecialchars($_SESSION['codigo'], ENT_QUOTES, 'UTF-8') . '</div>
                            <p>Este código é válido por 10 minutos. Clique no botão abaixo para redefinir sua senha:</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <p>Coordenadoria Regional de Desenvolvimento da Educação<br>
                            <a href="mailto:suporte@salaberga.com">suporte@salaberga.com</a> | <a href="https://salaberga.com">salaberga.com</a></p>
                            <p style="margin-top: 10px;">Se você não solicitou esta recuperação, ignore este e-mail.</p>
                        </td>
                    </tr>
                </table>
            </body>
            </html>';

                $mail->AltBody = "Olá,\n\nVocê solicitou a recuperação de senha para o Sistema Paróquia Digital. Use o código abaixo para redefinir sua senha:\n\n" . $_SESSION['codigo'] . "\n\nEste código é válido por 10 minutos.";

                // Enviar e-mail
                $mail->send();
                error_log("E-mail enviado com sucesso para $email em " . date('Y-m-d H:i:s'));
                $_SESSION['email_success'] = 'E-mail de recuperação enviado com sucesso!';
                return 1;
            } catch (Exception $e) {
                error_log("Erro ao enviar e-mail para $email: {$mail->ErrorInfo} em " . date('Y-m-d H:i:s'));
                $_SESSION['email_error'] = 'Erro ao enviar o e-mail de recuperação. Tente novamente.';
                return 0;
            }
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function AddTelefone(int $id_user, string $telefone): int
    {
        try {
            $stmt_alterar = $this->connection->prepare("UPDATE {$this->tables['users']} SET telefone = :telefone WHERE id = :id");
            $stmt_alterar->bindParam(":telefone", $telefone);
            $stmt_alterar->bindParam(":id", $id_user);
            if (!$stmt_alterar->execute()) {
                return 2;
            }
            return 1;
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function AddFoto(int $id_user, array $foto): int
    {
        try {
            // Verificar se o arquivo foi enviado
            if (!isset($foto['tmp_name']) || empty($foto['tmp_name'])) {
                return 3;
            }

            // Verificar se houve erro no upload
            if ($foto['error'] !== UPLOAD_ERR_OK) {
                return 4;
            }

            // Verificar tipo de foto
            $tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($foto['type'], $tiposPermitidos)) {
                return 5;
            }

            // Verificar tamanho (máximo 5MB)
            if ($foto['size'] > 5 * 1024 * 1024) {
                return 6;
            }

            $stmt_check = $this->connection->prepare("SELECT foto_perfil FROM {$this->tables['users']} WHERE id = :id");
            $stmt_check->bindParam(":id", $id_user);
            $stmt_check->execute();
            $dado = $stmt_check->fetch(PDO::FETCH_ASSOC);
            $foto_perfil_antiga = $dado['foto_perfil'];

            // Criar pasta se não existir
            unlink('../assets/foto_perfil/' . $foto_perfil_antiga);

            $pastaDestino = __DIR__ . '/../assets/foto_perfil/';
            // Gerar nome único para o foto
            $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
            $nomeArquivo = 'perfil_' . $id_user . '_' . time() . '.' . $extensao;
            $caminhoCompleto = $pastaDestino . $nomeArquivo;

            // Mover foto
            if (move_uploaded_file($foto['tmp_name'], $caminhoCompleto)) {
                // Atualizar banco de dados
                $stmt = $this->connection->prepare("UPDATE {$this->tables['users']} SET foto_perfil = :foto_perfil WHERE id = :id");
                $stmt->bindValue(':foto_perfil', $nomeArquivo);
                $stmt->bindValue(':id', $id_user);

                if ($stmt->execute()) {
                    session_start();
                    $_SESSION['foto_perfil'] = $nomeArquivo;
                    return 1;
                } else {
                    // Se falhou no banco, remover foto
                    unlink($caminhoCompleto);
                    return 2;
                }
            } else {
                return 7;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    public function ReportarProblema(int $id_user, string $problema): int
    {
        try {

            date_default_timezone_get();
            $datetime = date('Y-m-d H:i:s');
            $stmt_alterar = $this->connection->prepare("INSERT INTO {$this->tables['prom']} VALUES(NULL, :problema, 'Pendente', :data_envio, :data_atualizacao, :id)");
            $stmt_alterar->bindParam(":problema", $problema);
            $stmt_alterar->bindParam(":data_envio", $datetime);
            $stmt_alterar->bindParam(":data_atualizacao", $datetime);
            $stmt_alterar->bindParam(":id", $id_user);
            if (!$stmt_alterar->execute()) {
                return 2;
            }
            return 1;
        } catch (PDOException $e) {
            return 0;
        }
    }
}
