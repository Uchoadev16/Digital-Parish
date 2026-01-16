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
else if (isset($_POST['alterar_foto']) && isset($_FILES['foto_perfil'])) {
    session_start();
    
    $arquivo = $_FILES['foto_perfil'];
    $id_usuario = $_SESSION['id'];
    
    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        
        if (in_array($extensao, $extensoes_permitidas)) {
            $diretorio = __DIR__ . '/../assets/foto_perfil/';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0755, true);
            }
            
            // Remove foto antiga se existir
            if (!empty($_SESSION['foto_perfil'])) {
                $foto_antiga = __DIR__ . '/../assets/foto_perfil/' . basename($_SESSION['foto_perfil']);
                if (file_exists($foto_antiga)) {
                    unlink($foto_antiga);
                }
            }
            
            $nome_arquivo = 'perfil_' . $id_usuario . '_' . time() . '.' . $extensao;
            $caminho_completo = $diretorio . $nome_arquivo;
            
            if (move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
                $caminho_relativo = $nome_arquivo;
                $model_usuario = new User();
                $result = $model_usuario->AddFoto($id_usuario, $caminho_relativo);
                
                if ($result === 1) {
                    $_SESSION['foto_perfil'] = $caminho_relativo;
                    header('Location: ../views/perfil.php?foto_atualizada');
                    exit();
                } else {
                    header('Location: ../views/perfil.php?erro_foto');
                    exit();
                }
            } else {
                header('Location: ../views/perfil.php?erro_upload');
                exit();
            }
        } else {
            header('Location: ../views/perfil.php?formato_invalido');
            exit();
        }
    } else {
        header('Location: ../views/perfil.php?erro_upload');
        exit();
    }
}