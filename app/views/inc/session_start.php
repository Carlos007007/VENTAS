<?php

    ini_set('session.use_strict_mode', '1');
    ini_set('session.gc_maxlifetime', TIEMPO_SESION);

    session_set_cookie_params([
        'samesite' => 'Strict',
        'lifetime' => TIEMPO_SESION,
        'httponly' => true,
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'

    ]);

    session_name(APP_SESSION_NAME);
    session_start();

    // Verificar expiración de la sesión por inactividad
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > TIEMPO_SESION) {
        session_unset();
        session_destroy();
        header("Location: " . APP_URL . "login/");
        exit();
    }
    $_SESSION['last_activity'] = time();