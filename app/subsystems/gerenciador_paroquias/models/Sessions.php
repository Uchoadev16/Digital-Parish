<?php
session_start();
class Sessions
{
    private int $tempo = 600;

    function __construct()
    {
        $this->AutenticarSessao();
        $this->TempoSessao();
    }
    public function AutenticarSessao()
    {
        if (
            !isset($_SESSION['email']) ||
            !isset($_SESSION['nome']) ||
            !isset($_SESSION['id']) ||
            !isset($_SESSION['paroquias_id']) ||
            !isset($_SESSION['perfis_id']) ||
            !isset($_SESSION['cpf'])
        ) {

            session_unset();
            session_destroy();
            header('location:../../main/views/login.php');
            exit();
        }
    }
    public function TempoSessao()
    {
        if (isset($_SESSION['ultimo_acesso'])) {

            if (time() - $_SESSION['ultimo_acesso'] > $this->tempo) {

                session_unset();
                session_destroy();
                header('location:../../main/views/login.php');
                exit();
            }
        }
        $_SESSION['ultimo_acesso'] = time();
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('location:../../main/views/login.php');
        exit();
    }
}
