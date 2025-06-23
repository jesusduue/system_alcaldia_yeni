
<?php
// Iniciar sesión al principio del archivo
/* if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar sesión y permisos
if (!isset($_SESSION["id_usu"])) {
    header("Location: ../../index.php");
    exit();
}
 */
// Incluir utilidad con ruta correcta
require_once('../../Backend/clase/utilidad.php');


$utilidad = new Utilidad();
$utilidad->que_bd = "SELECT * FROM logs_acceso ORDER BY fecha_hora DESC";
$utilidad->puntero = $utilidad->ejecutar();
$logs = $utilidad->extraer_todo();
?>
<?php include_once 'header.php'; ?>

    <title>Registro de Accesos</title>
    <link rel="stylesheet" href="../estilos/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        
        .access-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-top: 20px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 28px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        .filters {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }
        
        .filter-group input, .filter-group select {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            min-width: 200px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .tabla-datos th {
            background-color: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        .tabla-datos td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .tabla-datos tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .tabla-datos tr:hover {
            background-color: #e9f7fe;
        }
        
        .entry {
            color: #2ecc71;
            font-weight: 600;
        }
        
        .exit {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .user-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .admin-badge {
            background-color: #9b59b6;
            color: white;
        }
        
        .user-badge {
            background-color: #3498db;
            color: white;
        }
        
        .no-records {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .export-btn {
            margin-left: auto;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .export-btn:hover {
            background-color: #219653;
        }
    </style>

<?php include_once 'panel_navegacion.php'; ?>

</head>

    
    <div class="main-content">
        <div class="access-container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1><i class="fas fa-history"></i> Registro de Accesos al Sistema</h1>
                <a href="../../frontend/vista/gestion_de_usuarios.php" class="export-btn">
                    <i class="fas fa-file-export"></i> regresar
                </a>
            </div>
            
            <div class="filters">
                <div class="filter-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha">
                </div>
                
                <div class="filter-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Buscar usuario...">
                </div>
                
                <div class="filter-group">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo">
                        <option value="todos">Todos</option>
                        <option value="entrada">Entradas</option>
                        <option value="salida">Salidas</option>
                    </select>
                </div>
                
                <button class="btn btn-primary" style="align-self: flex-end;">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
            
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Evento</th>
                        <th>Fecha/Hora</th>
                        <th>Duración</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr>
                            <td colspan="6" class="no-records">
                                <i class="fas fa-info-circle"></i> No se encontraron registros de acceso
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?php echo $log['id_log']; ?></td>
                            <td><?php echo htmlspecialchars($log['nombre_usuario']); ?></td>
                            <td>
                                <span class="user-badge <?php echo $log['rol_usuario'] == 'admin' ? 'admin-badge' : 'user-badge'; ?>">
                                    <?php echo htmlspecialchars($log['rol_usuario']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($log['tipo_evento'] == 'entrada'): ?>
                                    <span class="entry"><i class="fas fa-sign-in-alt"></i> Entrada</span>
                                <?php else: ?>
                                    <span class="exit"><i class="fas fa-sign-out-alt"></i> Salida</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($log['fecha_hora'])); ?></td>
                            <td>
                                <?php 
                                // Calcular duración si es una sesión completa (entrada + salida)
                                // Esto requeriría lógica adicional en tu base de datos
                                echo '--'; 
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Script para filtrado en el cliente (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.querySelector('.btn-primary');
            const fechaInput = document.getElementById('fecha');
            const usuarioInput = document.getElementById('usuario');
            const tipoSelect = document.getElementById('tipo');
            const rows = document.querySelectorAll('.tabla-datos tbody tr');
            
            filterBtn.addEventListener('click', function() {
                const fechaValue = fechaInput.value;
                const usuarioValue = usuarioInput.value.toLowerCase();
                const tipoValue = tipoSelect.value;
                
                rows.forEach(row => {
                    if (row.classList.contains('no-records')) return;
                    
                    const fechaCell = row.cells[4].textContent;
                    const usuarioCell = row.cells[1].textContent.toLowerCase();
                    const tipoCell = row.cells[3].textContent.toLowerCase();
                    
                    const fechaMatch = !fechaValue || fechaCell.includes(fechaValue.split('-').reverse().join('/'));
                    const usuarioMatch = !usuarioValue || usuarioCell.includes(usuarioValue);
                    const tipoMatch = tipoValue === 'todos' || tipoCell.includes(tipoValue);
                    
                    row.style.display = (fechaMatch && usuarioMatch && tipoMatch) ? '' : 'none';
                });
            });
        });
    </script>
<?php include_once 'footer.php'; ?>