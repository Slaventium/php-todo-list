<?php

if (!isset($_SESSION)) {
    session_start();
}

if (array_key_exists('referer', $_SESSION) && empty($_SESSION['referer']['previousPage'])) {
    $_SESSION = [
        'referer' => [
            'previousPage' => $_SERVER['PHP_SELF'],
            'currentPage'  => $_SERVER['PHP_SELF'],
        ],
    ];
} else {
    if ($_SERVER['PHP_SELF'] !== $_SESSION['referer']['currentPage']) {
        $_SESSION['referer']['previousPage'] = $_SESSION['referer']['currentPage'];
    }

    $_SESSION['referer']['currentPage'] = $_SERVER['PHP_SELF'];
}

if (!isset($_SESSION['authenticated_user']) && $_SERVER['PHP_SELF'] !== '/login') {
    header('Location: /login');
} else if (isset($_SESSION['authenticated_user']) && $_SERVER['PHP_SELF'] === '/login') {
    header('Location: /create-task');
}
