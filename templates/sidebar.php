<?php
/**
 * templates/sidebar.php
 * Sidebar reutilizable para las páginas de administrador.
 *
 * USO desde public/:
 *   <?php $activePage = 'admin'; include '../templates/sidebar.php'; ?>
 *
 * Valores de $activePage: 'admin' | 'registrar' | 'clubes'
 */
?>

<div class="sidebar">
    <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro">

    <a href="admin.php"
        class="nav-link <?= ($activePage === 'admin') ? 'active' : '' ?>">
        Dashboard
    </a>

    <a href="registrar.php"
        class="nav-link <?= ($activePage === 'registrar') ? 'active' : '' ?>">
        Insertar Alumno
    </a>

    <a href="vista_clubes.php"
        class="nav-link <?= ($activePage === 'clubes') ? 'active' : '' ?>">
        Vista de Clubes
    </a>

    <a href="../src/logout.php" class="btn-logout">
        Cerrar Sesión
    </a>
</div>