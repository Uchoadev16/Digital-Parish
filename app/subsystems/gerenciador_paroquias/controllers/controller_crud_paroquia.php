<?php
require_once(__DIR__ . "/../models/Admin.php");
require_once(__DIR__ . "/../models/Sessions.php");
$session = new Sessions();
if (isset($_GET['logout'])) {
    $session->logout();
}

echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

// Cadastro de paróquia (form da view cadastrar.php)
if (
    isset($_POST['nome'])  && !empty($_POST['nome']) && is_string($_POST['nome']) &&
    isset($_POST['cnpj'])  && !empty($_POST['cnpj']) && is_string($_POST['cnpj']) &&
    isset($_POST['endereco'])  && !empty($_POST['endereco']) && is_string($_POST['endereco']) &&
    isset($_POST['telefone'])  && !empty($_POST['telefone']) && is_string($_POST['telefone']) &&
    isset($_POST['secretario_nome'])  && !empty($_POST['secretario_nome']) && is_string($_POST['secretario_nome']) &&
    isset($_POST['secretario_email'])  && !empty($_POST['secretario_email']) && is_string($_POST['secretario_email']) &&
    isset($_POST['secretario_cpf'])  && !empty($_POST['secretario_cpf']) && is_string($_POST['secretario_cpf']) &&
    isset($_POST['paroco_nome'])  && !empty($_POST['paroco_nome']) && is_string($_POST['paroco_nome']) &&
    isset($_POST['paroco_email'])  && !empty($_POST['paroco_email']) && is_string($_POST['paroco_email']) &&
    isset($_POST['paroco_nome'])  && !empty($_POST['paroco_nome']) && is_string($_POST['paroco_nome']) &&
    isset($_FILES['logo'])  && !empty($_FILES['logo']) && is_array($_FILES['logo'])
) {
    $nome_paroquia = trim((string) $_POST['nome']);
    $cnpj = trim((string) $_POST['cnpj']);
    $localizacao = trim((string) $_POST['endereco']);
    $telefone = trim((string) $_POST['telefone']);
    $secretario_nome = trim((string) $_POST['secretario_nome']);
    $secretario_email = trim($_POST['secretario_email']);
    $secretario_cpf = trim((string) $_POST['secretario_cpf']);
    $paroco_nome = trim((string) $_POST['paroco_nome']);
    $paroco_email = trim($_POST['paroco_email']);
    $paroco_cpf = trim((string) $_POST['paroco_cpf']);
    $logo = $_FILES['logo'];

    $model_admin = new Admin();
    $result = $model_admin->CadastrarParoquia(
        $nome_paroquia,
        $localizacao,
        $cnpj,
        $telefone,
        $logo,
        $secretario_nome,
        $secretario_email,
        $secretario_cpf,
        $paroco_nome,
        $paroco_email,
        $paroco_cpf
    );

    switch ($result) {
        case 1:
            header('Location: ../index.php?cadastrado');
            exit;
        case 2:
            header('Location: ../views/cadastrar.php?erro');
            exit;
        case 3:
            header('Location: ../views/cadastrar.php?cnpj_duplicado');
            exit;
        case 4:
            header('Location: ../views/cadastrar.php?erro_arquivo');
            exit();
        case 5:
            header('Location: ../views/cadastrar.php?tipo_foto_invalido');
            exit();
        case 6:
            header('Location: ../views/cadastrar.php?tamanho_maximo');
            exit();
        case 7:
            header('Location: ../views/cadastrar.php?foto_nao_movida');
            exit();
        case 8:
            header('Location: ../views/cadastrar.php?arquivo_vazio');
            exit();
        case 9:
            header('Location: ../views/cadastrar.php?telefone_duplicado');
            exit();
        default:
            header('Location: ../views/cadastrar.php?falha');
            exit;
    }
} else if (
    isset($_POST['email'])  && !empty($_POST['email']) && is_string($_POST['email']) &&
    isset($_POST['cpf'])  && !empty($_POST['cpf']) && is_string($_POST['cpf']) &&
    isset($_POST['id_paroquia'])  && !empty($_POST['id_paroquia']) && is_string($_POST['id_paroquia'])
) {
    $email = trim($_POST['email']);
    $cpf = trim($_POST['cpf']);
    $id_paroquia = trim($_POST['id_paroquia']);

    $model_admin = new Admin();
    $result = $model_admin->EmailExcluirParoquia($email, $cpf, $id_paroquia);

    switch ($result) {
        case 1:
            header('Location: ../index.php?email_enviado');
            exit;
        case 2:
            header('Location: ../index.php?erro');
            exit;
        case 3:
            header('Location: ../index.php?paroquia_nao_existe');
            exit;
        case 4:
            header('Location: ../index.php?email_cpf_invalidos');
            exit;
        case 5:
            header('Location: ../index.php?erro_envio_email');
            exit;
        default:
            header('Location: ../index.php?falha');
            exit;
    }
} else if (
    isset($_POST['email'])  && !empty($_POST['email']) && is_string($_POST['email']) &&
    isset($_POST['cpf'])  && !empty($_POST['cpf']) && is_string($_POST['cpf']) &&
    isset($_POST['codigo'])  && !empty($_POST['codigo']) && is_string($_POST['codigo'])
) {
    $email = trim($_POST['email']);
    $cpf = trim($_POST['cpf']);
    $codigo = trim($_POST['codigo']);

    $model_admin = new Admin();
    $result = $model_admin->VerificarCodigo($email, $cpf, (int)$codigo);

    switch ($result) {
        case 1:
            header('Location: ../index.php?paroquia_excluida');
            exit;
        case 2:
            header('Location: ../index.php?codigo_expirado');
            exit;
        case 3:
            header('Location: ../index.php?erro_exclusao');
            exit;
        case 4:
            header('Location: ../index.php?email_cpf_invalidos');
            exit;
        case 5:
            header('Location: ../index.php?codigo_incorreto');
            exit;
        default:
            header('Location: ../index.php?falha');
            exit;
    }

} else {
    header('location: ../index.php');
    exit;
}
