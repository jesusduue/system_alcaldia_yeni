<?php include_once 'header.php'; ?>
<?php include_once 'panel_navegacion.php'; ?>

<title>Gestión de Usuarios</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../estilos/css/style.css">
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

    .user-management table td .action-buttons a {
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: white;
    }

    .user-management table td .action-buttons .edit {
        background-color: #28a745;
    }

    .user-management table td .action-buttons .edit:hover {
        background-color: #218838;
    }

    .user-management table td .action-buttons .delete {
        background-color: #dc3545;
    }

    .user-management table td .action-buttons .delete:hover {
        background-color: #c82333;
    }

    .user-management table td .action-buttons .security {
        background-color: #17a2b8;
    }

    .user-management table td .action-buttons .security:hover {
        background-color: #138496;
    }

    .action-buttons a::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 350px;
        left: 55%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 10;
    }

    .action-buttons a:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* ───── Estilos para modales ───── */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background: rgba(0, 0, 0, .4);
    }

    .modal-content {
        background: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .2);
        animation: fadeIn .3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    .modal-content .form-group {
        margin-bottom: 15px;
    }

    .modal-content label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .modal-content input,
    .modal-content select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .modal-content button[type="submit"] {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-content button[type="submit"]:hover {
        background: #0056b3;
    }
</style>

<main>
    <div class="main-content">
        <div class="user-management">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Gestión de Usuarios</h2>
                <a href="listado_accesos.php" class="btn btn-info">
                    <i class="fas fa-history"></i> Ver Registro de Accesos
                </a>
            </div>
            
            <p>Bienvenido a la sección de gestión de usuarios. Aquí puedes agregar, editar y eliminar usuarios del sistema.</p>

            <!-- Botón para agregar usuario -->
            <a id="btnOpenModalAdd" class="add-user"><i class="fas fa-user-plus"></i> Agregar Usuario</a>

            <!-- Modal para agregar usuario -->
            <div id="modalAdd" class="modal">
                <div class="modal-content">
                    <span class="close" data-close="modalAdd">&times;</span>
                    <h3>Nuevo Usuario</h3>
                    <form action="../../Backend/Controlador/usuario.php" method="POST" onsubmit="return validarFormulario('add')">
                        <div class="form-group">
                            <label for="nom_usu_add">Nombre del Empleado:</label>
                            <input type="text" name="nom_usu" id="nom_usu_add" required>
                        </div>
                        <div class="form-group">
                            <label for="cla_usu_add">Clave:</label>
                            <input type="password" name="cla_usu" id="cla_usu_add" required>
                        </div>
                        <div class="form-group">
                            <label for="fky_rol_add">Cargo:</label>
                            <select name="fky_rol" id="fky_rol_add" required>
                                <option value="1">Admin</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="est_usu_add">Estado:</label>
                            <select name="est_usu" id="est_usu_add" required>
                                <option value="a">Activo</option>
                                <option value="i">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pregunta_seguridad_add">Pregunta de Seguridad:</label>
                            <select name="pregunta_seguridad" id="pregunta_seguridad_add" required>
                                <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                                <option value="¿Cuál es tu color favorito?">¿Cuál es tu color favorito?</option>
                                <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="respuesta_seguridad_add">Respuesta de Seguridad:</label>
                            <input type="text" name="respuesta_seguridad" id="respuesta_seguridad_add" required>
                        </div>
                        <button type="submit" name="accion" value="insertar">Guardar</button>
                    </form>
                </div>
            </div>

            <!-- Modal para editar usuario -->
            <div id="modalEdit" class="modal">
                <div class="modal-content">
                    <span class="close" data-close="modalEdit">&times;</span>
                    <h3>Editar Usuario</h3>
                    <form action="../../Backend/controlador/usuario.php" method="POST" onsubmit="return validarFormulario('edit')">
                        <input type="hidden" name="id_usu" id="id_usu_edit">
                        <div class="form-group">
                            <label for="nom_usu_edit">Nombre del Empleado:</label>
                            <input type="text" name="nom_usu" id="nom_usu_edit" required>
                        </div>
                        <div class="form-group">
                            <label for="cla_usu_edit">Clave:</label>
                            <input type="password" name="cla_usu" id="cla_usu_edit" required>
                        </div>
                        <div class="form-group">
                            <label for="fky_rol_edit">Cargo:</label>
                            <select name="fky_rol" id="fky_rol_edit" required>
                                <option value="1">Admin</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>
                        <button type="submit" name="accion" value="modificar">Actualizar</button>
                    </form>
                </div>
            </div>

            <!-- Tabla de usuarios -->
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('../../Backend/clase/usuario_class.php');
                    $obj_personal = new usuario;
                    $obj_personal->puntero = $obj_personal->listar();
                    while (($p = $obj_personal->extraer_dato()) !== null) {
                        echo "<tr>
                            <td>".htmlspecialchars($p['nom_usu'])."</td>
                            <td>".htmlspecialchars($p['rol'])."</td>
                            <td>".($p['est_usu'] == 'a' ? 'Activo' : 'Inactivo')."</td>
                            <td class='action-buttons'>
                                <a href='#' class='btn-edit edit' data-tooltip='MODIFICAR'
                                   data-id='".htmlspecialchars($p['id_usu'])."'
                                   data-nombre='".htmlspecialchars($p['nom_usu'])."'
                                   data-rol='".htmlspecialchars($p['fky_rol'])."'>
                                   <i class='fas fa-edit'></i></a>
                                <a href='../../Backend/controlador/usuario.php?accion=eliminar&id_usu=".htmlspecialchars($p['id_usu'])."'
                                   class='delete' data-tooltip='ELIMINAR'><i class='fas fa-eraser'></i></a>
                                <a href='configurar_preguntas.php?id_usu=".htmlspecialchars($p['id_usu'])."'
                                   class='security' data-tooltip='PREGUNTAS DE SEGURIDAD'><i class='fas fa-shield-alt'></i></a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    /* ========== Funciones modales ========= */
    const modalAdd = document.getElementById('modalAdd');
    const modalEdit = document.getElementById('modalEdit');
    
    // Abrir modal de agregar
    document.getElementById('btnOpenModalAdd').onclick = () => modalAdd.style.display = 'block';

    // Cerrar modales
    document.querySelectorAll('.close').forEach(btn => {
        btn.onclick = () => document.getElementById(btn.dataset.close).style.display = 'none';
    });

    // Cerrar al hacer clic fuera del modal
    window.onclick = e => {
        if (e.target === modalAdd) modalAdd.style.display = 'none';
        if (e.target === modalEdit) modalEdit.style.display = 'none';
    };

    // Abrir modal de editar y precargar datos
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            modalEdit.style.display = 'block';
            document.getElementById('id_usu_edit').value = btn.dataset.id;
            document.getElementById('nom_usu_edit').value = btn.dataset.nombre;
            document.getElementById('fky_rol_edit').value = btn.dataset.rol;
        });
    });

    /* ========== Validación ========= */
    function validarFormulario(mode) {
        const pref = mode === 'add' ? '_add' : '_edit';
        const nombre = document.getElementById('nom_usu' + pref).value.trim();
        const clave = document.getElementById('cla_usu' + pref).value.trim();
        const regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        
        if (!nombre || !clave) {
            alert("Todos los campos son obligatorios");
            return false;
        }
        
        if (!regexLetras.test(nombre)) {
            alert("El nombre debe contener solo letras");
            return false;
        }
        
        if (clave.length < 8) {
            alert("La clave debe tener al menos 8 caracteres");
            return false;
        }
        
        return true;
    }
</script>

<?php include_once 'footer.php'; ?>