<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['authenticated_user']) && $_SERVER['PHP_SELF'] !== '/login') {
    header('Location: /login');
} else if (isset($_SESSION['authenticated_user']) && $_SERVER['PHP_SELF'] === '/login') {
    header('Location: /create-task');
}
