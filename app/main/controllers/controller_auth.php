<?php
require_once(__DIR__ . "/../models/User.php");

echo "<pre>";
print_r($_POST);
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
    isset($_POST['cpf']) && !empty($_POST['cpf']) && is_string($_POST['cpf']) &&
    isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])
) {

    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

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
            header('Location: ../views/login.php?erro_email');
            exit();
        case 4:
            header('Location: ../views/login.php?erro_senha');
            exit();
        default:
            header('Location: ../views/login.php?falha');
            exit();
    }
} 
//esqueceu senha
else if(isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email'])){

}else{

    header('location:../views/login.php');
    exit();
}
