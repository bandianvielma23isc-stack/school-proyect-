<?php
/**
 * templates/sidebar.php
 * Sidebar reutilizable para las páginas de administrador.
 *
 * USO desde public/:
 * <?php $activePage = 'admin'; include '../templates/sidebar.php'; ?>
 *
 * Valores de $activePage: 'admin' | 'registrar' | 'insertar_maestro' | 'clubes'
 */
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="sidebar">
    <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro"
         id="logoBtn" style="cursor:pointer;" title="Volver al inicio">

    <a href="admin.php"
        class="nav-link <?= ($activePage === 'admin') ? 'active' : '' ?>">
        Dashboard
    </a>

    <a href="registrar.php"
        class="nav-link <?= ($activePage === 'registrar') ? 'active' : '' ?>">
        Insertar Alumno
    </a>

    <a href="insertar_maestro.php"
        class="nav-link <?= ($activePage === 'insertar_maestro') ? 'active' : '' ?>">
        Insertar Profesor
    </a>

    <a href="vista_clubes.php"
        class="nav-link <?= ($activePage === 'clubes') ? 'active' : '' ?>">
        Vista de Clubes
    </a>
    <a href="reportes.php"
        class="nav-link <?= ($activePage === 'reportes') ? 'active' : '' ?>">
        Reportes PDF
    </a>

    <a href="../src/logout.php" class="btn-logout">
        Cerrar Sesión
    </a>
</div>

<script>
    document.getElementById('logoBtn').addEventListener('click', function() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: 'Se cerrará tu sesión y volverás al inicio.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#B30000',
            cancelButtonColor: '#555',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../src/logout.php';
            }
        });
    });
</script>