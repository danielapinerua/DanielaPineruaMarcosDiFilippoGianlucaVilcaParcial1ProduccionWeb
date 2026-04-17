<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>

<a href="vehiculos.php">Ver vehículos</a><br>

<?php if ($_SESSION['rol'] === 'admin'): ?>
    <a href="gestion_usuarios.php">Gestionar usuarios</a><br>
<?php endif; ?>

<a href="../action/sesion/cerrar_sesion.php">Cerrar sesión</a>