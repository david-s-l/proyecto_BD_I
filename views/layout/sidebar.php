<?php 
$user = Auth::user(); 

// Si no hay usuario logueado, NO cargar sidebar
if (!$user) {
    return;
}

$rol = $user['id_rol'];
?>

<div class="sidebar">

    <!-- CUADRO DE MANDO (visible para todos) -->
    <a href="<?= base_url ?>Dashboard/index" class="sidebar-item active">📊 Cuadro de Mando</a>



    <!-- ===================== -->
    <!-- 👤 USUARIOS (solo ADMIN) -->
    <!-- ===================== -->
    <?php if ($rol == 1): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">👤 Usuarios</div>
        <div class="submenu">
            <a href="<?= base_url ?>usuario/listar" class="submenu-item">📋 Gestión Usuarios</a>
        </div>

        <!-- ROLES -->
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">🎭 Roles</div>
        <div class="submenu">
            <a href="<?= base_url ?>rol/index" class="submenu-item">📋 Gestión Roles</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 👥 CLIENTES (Admin y Vendedor) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 2): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">👥 Clientes</div>
        <div class="submenu">
            <a href="<?= base_url ?>cliente/listar" class="submenu-item">📋 Gestión Clientes</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 🏭 PROVEEDORES (Admin y Almacenero) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 3): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">🏭 Proveedores</div>
        <div class="submenu">
            <a href="<?= base_url ?>proveedor/listar" class="submenu-item">📋 Gestión Proveedores</a>
        <!--            
            <a href="<?= base_url ?>proveedor/compras" class="submenu-item">📈 Compras por Proveedor</a>
        -->
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 📦 PRODUCTOS (Admin, Almacenero, Supervisor) -->
    <!-- ===================== -->
    <?php if (in_array($rol, [1, 3, 4])): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">📦 Productos & Servicios</div>
        <div class="submenu">
            <a href="<?= base_url ?>producto/listar" class="submenu-item">📋 Gestión Productos</a>
            <a href="<?= base_url ?>categoria/listar" class="submenu-item">📂 Categorías</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 📊 INVENTARIO (Admin y Almacenero) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 3): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">📊 Inventario</div>
        <div class="submenu">
            <a href="<?= base_url ?>inventario/listar" class="submenu-item">📦 Ver Inventario</a>
            <a href="<?= base_url ?>inventario/movimientos" class="submenu-item">🔄 Movimientos</a>
            <a href="<?= base_url ?>inventario/entrada" class="submenu-item">📥 Entrada</a>
            <a href="<?= base_url ?>inventario/salida" class="submenu-item">📤 Salida</a>
            <a href="<?= base_url ?>inventario/ajustes" class="submenu-item">⚙️ Ajustes</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 🛒 COMPRAS (Admin y Almacenero) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 3): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">🛒 Compras</div>
        <div class="submenu">
            <a href="<?= base_url ?>compras/listar" class="submenu-item">📋 Gestión Compras</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 💰 VENTAS (Admin y Vendedor) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 2): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">💰 Ventas</div>
        <div class="submenu">
            <a href="<?= base_url ?>ventas/listar" class="submenu-item">📋 Gestión Ventas</a>
            <a href="<?= base_url ?>ventas/analisis" class="submenu-item">📈 Análisis de Ventas</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 📄 REPORTES (Admin, Supervisor) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 4): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">📄 Reportes</div>
        <div class="submenu">
            <a href="<?= base_url ?>reportes/ventas_fecha" class="submenu-item">📅 Ventas por Fecha</a>
            <a href="<?= base_url ?>reportes/productos_vendidos" class="submenu-item">📦 Productos Vendidos</a>
            <a href="<?= base_url ?>reportes/compras_proveedor" class="submenu-item">🏭 Compras por Proveedor</a>
            <a href="<?= base_url ?>reportes/ganancias_mes" class="submenu-item">💵 Ganancias del Mes</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- MÉTODOS DE PAGO (Admin) -->
    <!-- ===================== -->
    <?php if ($rol == 1): ?>
        <div class="sidebar-item has-submenu" onclick="toggleSubmenu(this)">💳 Métodos de Pago</div>
        <div class="submenu">
            <a href="<?= base_url ?>metodoPago/listar" class="submenu-item">📋 Gestión</a>
        </div>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- 🔍 Auditoría (Admin y Técnico) -->
    <!-- ===================== -->
    <?php if ($rol == 1 || $rol == 5): ?>
        <a href="<?= base_url ?>auditoria/index" class="sidebar-item">🔍 Auditoría</a>
    <?php endif; ?>



    <!-- ===================== -->
    <!-- Mi cuenta (todos) -->
    <!-- ===================== -->
    <a href="<?= base_url ?>cuenta/index" class="sidebar-item">👤 Mi Cuenta</a>



    <!-- ===================== -->
    <!-- Configuración (solo Admin) -->
    <!-- ===================== -->
    <?php if ($rol == 1): ?>
        <a href="<?= base_url ?>config/index" class="sidebar-item">🔧 Configuración</a>
    <?php endif; ?>



    <!-- CERRAR SESIÓN -->
     <a href="<?= base_url ?>Usuario/logout" class="sidebar-item">⬅️ Cerrar sesión</a>

</div>
