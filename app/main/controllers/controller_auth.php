<?php
require_once(__DIR__ . "/../models/User.php");

echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
//pre-cadastro
if (
    isset($_POST['cpf']) && !empty($_POST['cpf']) && is_string($_POST['cpf']) &&
    isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])
) {

    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $model_usuario = new User();
    $result = $model_usuario->PreCadastro($email, $cpf);

    switch ($result) {
        case 1:
            header('Location: ../views/primeiro_acesso.php?verificado');
            exit();
        case 2:
            header('Location: ../views/primeiro_acesso.php?erro');
            exit();
        case 3:
            header('Location: ../views/primeiro_acesso.php?nao_existe');
            exit();
        default:
            header('Location: ../views/primeiro_acesso.php?fatal');
            exit();
    }
}
//primeiro acesso
else if (
    isset($_POST['senha']) && !empty($_POST['senha']) && is_string($_POST['senha']) &&
    isset($_POST['confirmar_senha']) && !empty($_POST['confirmar_senha']) && is_string($_POST['confirmar_senha']) &&
    isset($_POST['CPF']) && !empty($_POST['CPF']) && is_string($_POST['CPF']) &&
    isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])
) {

    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $cpf = $_POST['CPF'];

    if ($senha !== $confirmar_senha) {

        header('location:../views/primeiro_acesso.php?senhas_nao_condizem');
        exit();
    }

    $model_usuario = new User();
    $result = $model_usuario->PrimeiroAcesso($cpf, $email, $senha);

    switch ($result) {
        case 1:
            header('Location: ../views/login.php');
            exit();
        case 2:
            header('Location: ../views/primeiro_acesso.php?erro');
            exit();
        case 3:
            header('Location: ../views/login.php?nao_existe');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
}
//login
else if (
    isset($_POST['senha']) && !empty($_POST['senha']) && is_string($_POST['senha']) &&
    isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])
) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $model_usuario = new User();
    $result = $model_usuario->Login($email, $senha);

    switch ($result) {
        case 1:
            header('Location: ../views/subsystems.php');
            exit();
        case 2:
            header('Location: ../views/login.php?erro');
            exit();
        case 3:
            header('Location: ../views/login.php?erro_email_senha');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
}
//esqueceu senha
else if (isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])) {
} else if (isset($_POST['email'])) {

    header('location:../views/login.php');
    exit();
} else if (isset($_POST['telefone']) && !empty($_POST['telefone'])) {

    session_start();
    $telefone = $_POST['telefone'];
    $id_usuario = $_SESSION['id'];
    $model_usuario = new User();
    $result = $model_usuario->AddTelefone($id_usuario, $telefone);

    switch ($result) {
        case 1:
            header('Location: ../views/perfil.php?telefone_editado');
            exit();
        case 2:
            header('Location: ../views/perfil.php?erro');
            exit();
        default:
            header('Location: ../views/perfil.php?falha');
            exit();
    }
}
//alterar foto de perfil
else if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario']) && isset($_FILES['foto_perfil']) && !empty($_FILES['foto_perfil'])) {
    $id_usuario = $_POST['id_usuario'];
    $foto = $_FILES['foto_perfil'];

    $model_usuario = new User();
    $result = $model_usuario->AddFoto($id_usuario, $foto);

    switch ($result) {
        case 1:
            header('Location: ../views/perfil.php?foto_editada');
            exit();
        case 2:
            header('Location: ../views/perfil.php?erro');
            exit();
        case 3:
            header('Location: ../views/perfil.php?arquivo_vazio');
            exit();
        case 4:
            header('Location: ../views/perfil.php?erro_arquivo');
            exit();
        case 5:
            header('Location: ../views/perfil.php?tipo_foto_invalido');
            exit();
        case 6:
            header('Location: ../views/perfil.php?tamanho_maximo');
            exit();
        case 7:
            header('Location: ../views/perfil.php?foto_nao_movida');
            exit();
        default:
            header('Location: ../views/perfil.php?falha');
            exit();
    }
}
