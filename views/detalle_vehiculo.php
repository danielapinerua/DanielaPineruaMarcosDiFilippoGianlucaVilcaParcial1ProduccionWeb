<?php
include_once('componentes/header.php');
require_once('../action/CRUD_Vehiculos/VehiculoServicio.php');

$id = $_GET['id'];

$conexion = BD::getInstancia();
$sql = "SELECT * FROM vehiculos WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->execute([':id' => $id]);

$vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<main>
    <h1><?php echo $vehiculo['marca'] . " " . $vehiculo['modelo']; ?></h1>
    <img src="../imagenes/<?php echo $vehiculo['imagen'] . ".webp"; ?>" alt="vehiculo">
    <p>Año: <?php echo $vehiculo['anio']; ?></p>
    <p>Precio: $<?php echo $vehiculo['precio']; ?></p>
    <p>Tipo: <?php echo $vehiculo['tipo']; ?></p>
    <p>Color: <?php echo $vehiculo['color']; ?></p>
    <p>Transmisión: <?php echo $vehiculo['transmision']; ?></p>
</main>

<?php
include_once('componentes/footer.php');

?>