<?php include_once './layout/header.php'; ?>

<title>Gestión de Usuarios</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../public/css/style.css">
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        background-color: #f4f4f4;
    }

    .main-content {
        margin-left: 250px;
        margin-top: 50px;
        padding: 20px;
        box-sizing: border-box;
        width: calc(100% - 250px);
    }

    .user-management {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .user-management h2 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }

    .user-management .add-user {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .user-management .add-user:hover {
        background-color: #0056b3;
    }

    .user-management table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-management table th,
    .user-management table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .user-management table th {
        background-color: #f4f4f4;
        color: #333;
    }

    .user-management table td .action-buttons {
        display: flex;
        gap: 10px;
    }

    .user-management table td .action-buttons button {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .user-management table td .action-buttons .edit {
        background-color: #28a745;
        color: white;
    }

    .user-management table td .action-buttons .edit:hover {
        background-color: #218838;
    }

    .user-management table td .action-buttons .delete {
        background-color: #dc3545;
        color: white;
    }

    .user-management table td .action-buttons .delete:hover {
        background-color: #c82333;
    }
</style>
</head>
<main>
    <?php include_once './layout/nav.php'; ?>
    <div class="main-content">
        <div class="user-management">
            <h2>Gestión de Usuarios</h2>
            <a href="#add-user" class="add-user"><i class="fas fa-user-plus"></i> Agregar Usuario</a>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('../../Backend/Clase/personal.class.php');
                    $obj_personal = new personal;
                    $obj_personal->nom_usu = "nom_usu";
                    $obj_personal->puntero = $obj_personal->listar();

                    $i = 0;
                    while (($personal = $obj_personal->extraer_dato()) !== null) {
                        echo "<tr>
                                
                                <td>" . htmlspecialchars($personal['nom_usu']) . "</td>
                                <td>" . htmlspecialchars($personal['cla_usu']) . "</td>
                                <td>" . htmlspecialchars($personal['id_rol']) . "</td>
                                <td>
                                    <a href='../../Backend/Controlador/personal.php?accion=eliminar&id_usu=" . htmlspecialchars($personal['id_usu']) . "' class='btn-delete'>ELIMINAR</a>
                                    <a href='modificar.personal.php?id_usu=" . htmlspecialchars($personal['id_usu']) . "' class='btn-edit'>MODIFICAR</a>
                                </td>
                            </tr>";
                        $i++;
                    }
                    if ($i == 0) {
                        echo "<script language='javascript'>
                                alert('No hay registros');
                                document.location='registrar.personal.php';
                            </script>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    function validarFormulario() {
        var nombre = document.getElementById("nom_usua").value;
        var clave = document.getElementById("cla_usu").value;

        // Expresión regular para letras
        var regexLetras = /^[a-zA-Z\s]+$/;

        if (nombre === "" || clave === "") {
            alert("Todos los campos son obligatorios");
            return false;
        }

        if (!nombre.match(regexLetras)) {
            alert("El campo 'Nombre del Empleado' debe contener solo letras");
            return false;
        }

        return true;
    }
</script>


<?php include_once './layout/footer.php'; ?>