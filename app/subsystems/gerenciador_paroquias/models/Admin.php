<?php
require_once(__DIR__ . "/Sessions.php");
$session = new Sessions();
if (isset($_GET['logout'])) {
    $session->logout();
}
require_once(__DIR__ . "/SelectMain.php");
require_once('../src/PHPMailer.php');
require_once('../src/SMTP.php');
require_once('../src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

    public function EmailExcluirParoquia(string $email, string $cpf, int $id_paroquia): int
    {
        try {
            $stmt_check = $this->connection->prepare("SELECT * FROM {$this->tables['users']} WHERE email = :email AND cpf = :cpf");
            $stmt_check->bindParam(":email", $email);
            $stmt_check->bindParam(":cpf", $cpf);
            if (!$stmt_check->execute()) {
                return 2;
            }
            if ($stmt_check->rowCount() == 0) {
                return 3;
            }
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['email_excluir_paroquia'] = $email;
            $_SESSION['cpf_excluir_paroquia'] = $cpf;
            $_SESSION['id_paroquia_excluir'] = $id_paroquia;
            $_SESSION['codigo'] = random_int(100000, 999999);

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
                $mail->Subject = 'Deletar paróquia - Paróquia Digital';
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
                            <img src="../../../main/assets/logo.jpg" alt="Logo Salaberga">                         </td>
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

    public function VerificarCodigo(string $email, string $cpf, int $codigo): int
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (
                !isset($_SESSION['email_excluir_paroquia'], $_SESSION['cpf_excluir_paroquia'], $_SESSION['codigo'], $_SESSION['id_paroquia_excluir'])
            ) {
                return 2;
            }

            if ($email !== $_SESSION['email_excluir_paroquia'] || $cpf !== $_SESSION['cpf_excluir_paroquia']) {
                return 4;
            }

            if ((int)$codigo !== (int)$_SESSION['codigo']) {
                return 5;
            }

            $id_paroquia = (int)$_SESSION['id_paroquia_excluir'];

            $stmt_dados_users = $this->connection->query("SELECT id, foto_perfil FROM {$this->tables['users']} WHERE fk_paroquias_id = '$id_paroquia'");
            $dados_users = $stmt_dados_users->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dados_users as $dado) {
                $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['perm']} WHERE fk_usuarios_id = '{$dado['id']}'");
                unlink('../../../main/assets/foto_perfil/' . $dado['logo']);

            }
            foreach ($dados_users as $dado) {
                $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['prom']} WHERE fk_usuarios_id = '{$dado['id']}'");
            }
            $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['comm']} WHERE fk_paroquias_id = '$id_paroquia'");
            
            $stmt_logo_paroquia = $this->connection->query("SELECT logo FROM {$this->tables['pari']} WHERE id = '$id_paroquia'");
            $logo = $stmt_logo_paroquia->fetch(PDO::FETCH_ASSOC);

            unlink('../../../main/assets/logo_paroquia/' . $logo['logo']);

            $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['users']} WHERE fk_paroquias_id = '$id_paroquia'");
            $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['prof']} WHERE fk_paroquias_id = '$id_paroquia'");
            $stmt_delete = $this->connection->query("DELETE FROM {$this->tables['pari']} WHERE id = '$id_paroquia'");

            unset($_SESSION['email_excluir_paroquia'], $_SESSION['cpf_excluir_paroquia'], $_SESSION['codigo'], $_SESSION['id_paroquia_excluir']);

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}
