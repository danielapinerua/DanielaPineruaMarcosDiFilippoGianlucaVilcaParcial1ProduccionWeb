<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
         <?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Email o contraseña incorrectos</p>
<?php endif; ?>
        <form method="POST" action="../action/sesion/procesar_login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Ingresar</button>
</form>
        
    </main>
</body>
</html>