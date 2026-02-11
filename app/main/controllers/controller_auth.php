<?php
require_once(__DIR__ . "/../models/User.php");
session_start();
/*
echo "<pre>";
print_r($_POST);
print_r($_FILES);
print_r($_SESSION);
echo "</pre>";
*/
//pre-cadastro
if (
    isset($_POST['cpf']) && !empty($_POST['cpf']) && is_string($_POST['cpf']) &&
    isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])
) {

    $email = trim($_POST['email']);
    $cpf = trim($_POST['cpf']);

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
    $email = trim($_POST['email']);
    $cpf = trim($_POST['CPF']);

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

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

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

    $email = trim($_POST['email']);

    $model_usuario = new User();
    $result = $model_usuario->EsqueceuSenha($email);

    switch ($result) {
        case 1:
            header('Location: ../views/esquecer_senha.php?codigo_enviado');
            exit();
        case 2:
            header('Location: ../views/esquecer_senha.php?erro');
            exit();
        case 3:
            header('Location: ../views/esquecer_senha.php?email_nao_existe');
            exit();
        case 4:
            header('Location: ../views/esquecer_senha.php?erro_enviar_email');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
} else if (isset($_POST['reenviar_codigo'])) {

    $email = $_SESSION['email_recuperar_senha'];
    $model_usuario = new User();
    $result = $model_usuario->EsqueceuSenha($email);

    switch ($result) {
        case 1:
            header('Location: ../views/esquecer_senha.php?codigo_enviado');
            exit();
        case 2:
            header('Location: ../views/esquecer_senha.php?erro');
            exit();
        case 3:
            header('Location: ../views/esquecer_senha.php?email_nao_existe');
            exit();
        case 4:
            header('Location: ../views/esquecer_senha.php?erro_enviar_email');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
} else if (
    isset($_POST['codigo']) && !empty($_POST['codigo']) && is_string($_POST['codigo'])
) {

    $codigo = trim($_POST['codigo']);
    if ($codigo == $_SESSION['codigo']) {

        header('location: ../views/esquecer_senha.php?rec_senha');
        exit();
    } else {

        header('location: ../views/esquecer_senha.php?codigo_enviado&erro_codigo');
        exit();
    }
} else if (
    isset($_POST['new_password']) && !empty($_POST['new_password']) && is_string($_POST['new_password']) &&
    isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && is_string($_POST['confirm_password'])
) {

    $senha = $_POST['new_password'];
    $confirmar_senha = $_POST['confirm_password'];
    $email = trim($_SESSION['email_recuperar_senha']);

    if ($senha !== $confirmar_senha) {

        header('location:../views/esquecer_senha.php?rec_senha&senha_nao_condizem');
        exit();
    }
    $model_usuario = new User();
    $result = $model_usuario->AlteraSenha($email, $senha);

    switch ($result) {
        case 1:
            header('Location: ../views/login.php?senha_alterada');
            exit();
        case 2:
            header('Location: ../views/esquecer_senha.php?rec_senha&erro');
            exit();
        case 3:
            header('Location: ../views/login.php?email_nao_existe');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
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
} else if (isset($_POST['problema']) && !empty($_POST['problema'])) {

    session_start();
    $telefone = $_POST['problema'];
    $id_usuario = $_SESSION['id'];
    $model_usuario = new User();
    $result = $model_usuario->ReportarProblema($id_usuario, $telefone);

    switch ($result) {
        case 1:
            header('Location: ../views/problemas.php?problema_reportado');
            exit();
        case 2:
            header('Location: ../views/problemas.php?erro');
            exit();
        default:
            header('Location: ../views/problemas.php?falha');
            exit();
    }
} else {
    session_destroy();
    session_unset();
    header('location: ../index.php');
    exit;
}
