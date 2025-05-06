<?php
// layout/header.php
// Inicia la sesión (asegúrate de hacerlo en cada archivo que necesite acceder a la sesión)
session_start();

// Verifica si el usuario tiene sesión iniciada y tiene el rol de administrador o usuario
if (!isset($_SESSION["rol"]) || ($_SESSION["rol"] !== "admin" && $_SESSION["rol"] !== "usuario")) {
    header("Location:../../index.php"); // Redirige a la página de inicio de sesión si no cumple con los requisitos
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../lib/css/font-awesome-all.min.css">
    <link rel="stylesheet" href="../../lib/css/bootstrap.min.css">
    <link rel="icon" href="../../public/img/logo_alcaldia_la_fria.png" type="image/x-icon">
    <style>
    </style>
</head>

<body>