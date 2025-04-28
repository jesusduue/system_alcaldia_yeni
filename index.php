<?php include_once 'layout/header.php'; ?>
<title>Inicio de Sesión - SistemaPat</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-image: url('public/img/alcaldia.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-size: 100% 100%;

    }

    .login-container {
        width: 500px;
        max-width: 600px;
        height: 100vh; /* Ocupa todo el alto de la pantalla */
        position: fixed; /* Fija el contenedor a la izquierda */
        top: 0;
        left: 0;
        padding: 40px;
        border-right: 3px solid rgb(57, 87, 119);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin: auto;
        background-color: rgba(175, 174, 174, 0.7); /* Fondo blanco semi-transparente */
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2)); /* Sombra adicional */
        
    }
    img{
        margin-bottom: 20px;
        width: 900px; /* Adjust as needed */
        height: auto; /* Maintain aspect ratio */
    }

    .login-container h1 {
        margin-bottom: 10px;
        font-size: 24px;
        font-family: Algerian;
        color: #333;
    }

    .login-container h2 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #007bff;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .login-container button {
        padding: 10px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-container button:hover {
        background-color: #34495e;
    }

    .login-container a {
        margin-top: 10px;
        display: inline-block;
        font-size: 14px;
        color: #2c3e50;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }
  /*  .login-container .logo-container {
    
}*/

.login-container .logo-container img {
    width: 100px; /* Ajusta el ancho de las imágenes */
    height: auto; /* Mantiene la proporción */
}
</style>
<main>
    <div class="login-container">
        <div class="logo-container">
            <img src="public/img/logo_alcaldia_la_fria.png" alt="Logo Alcaldía">
        </div>
        <h1>Bienvenido a SistemaPat</h1>
        <h2>Gestión y Control de Patentes</h2>
        <p>Construyendo naciòn y forjando futuro</p>
        <form class="login" action="Admin/Controllers/LoginController.php" method="post">
            <input type="text" name="nom_usu" placeholder="Nombre de Usuario" required>
            <input type="password" name="clave_usu" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</main>
<?php include_once 'layout/footer.php'; ?>