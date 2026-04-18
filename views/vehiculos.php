<?php
include_once('componentes/header.php');
?>

<main>
    
        <h2>Vehículos</h2>
        <?php
        require_once('../src/servicios/VehiculoServicio.php');
        // contador REAL desde la base de datos
        $vehiculosDisponibles = VehiculoServicio::contarVehiculos();
        $vehiculos = VehiculoServicio::obtenerVehiculos();
        ?>  
        <p>Hay <?php echo $vehiculosDisponibles; ?> vehículos disponibles.</p>
        <section class="contenedor">

    <?php foreach ($vehiculos as $v): ?>
       <a href="detalle_vehiculo.php?id=<?php echo $v['id']; ?>" class="card">
            <img src="../img/<?php echo $v['imagen']; ?>" alt="vehiculo">
            <h3><?php echo $v['marca'] . " " . $v['modelo']; ?></h3>
            <p>Año: <?php echo $v['anio']; ?></p>
            <p>Precio: $<?php echo $v['precio']; ?></p>
        </a>
    <?php endforeach; ?>
    </section>
</main>

<?php
include_once('componentes/footer.php');
?>