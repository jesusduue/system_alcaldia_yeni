
<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<style>
    .container-manual{
        margin-right: 10px;
    }
</style>
<!-- Barra Lateral -->
<div class="sidebar oculto-impresion">
    <h2>Menú</h2>
    <ul>
        <li><img src="../estilos/img/logo_alcaldia_la_fria.png" alt="Logo Alcaldía" style="max-width: 60%; height: auto; display: block; margin: 0 auto;"></li>
        <li><a href="dashboard.php"><i class="fas fa-home"></i> INICIO</a></li>
        <li><a href="registrar_patente.php"><i class="fas fa-file-alt"></i> REGISTRAR PATENTE</a></li>
        <li><a href="listado_patente.php"><i class="fas fa-list"></i> LISTA PATENTE</a></li>
        <?php
        if ($_SESSION["rol"] === "admin") {
            echo '<li><a href="gestion_de_usuarios.php"><i class="fas fa-check-circle"></i> USUARIO AUTORIZADO</a></li>';
        }
        ?>
        
        <li><a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN</a></li>
    </ul>
</div>

<!-- Barra Superior -->
<div class="topbar oculto-impresion">
    <div class="container-manual">
        <a href="manual.php" style="color: #fff; font-family: inherit; font-size: inherit; font-weight: inherit; text-decoration: none;">
            <i href="manual.php" class="fas fa-book manual"></i> MANUAL
        </a>
    </div>
    <div class="profile">
        <img src="../estilos/img/logo_alcaldia_la_fria.png" alt="Perfil">
        <span>Mi Perfil  <?php echo $_SESSION["nom_usu"]; ?> (<?php echo $_SESSION["rol"]; ?>)</span>
    </div>
    <a href="cerrar_sesion.php" class="logout">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</div>
