<?php

class Autenticacao {
    public static function verificarAutenticacao($paginaLogin) {
        session_start();

        if (!isset($_SESSION['usuario_autenticado'])) {
            // O usuário não está autenticado, redireciona para a página de login
            header("Location: $paginaLogin");
            exit();
        }
    }
}
