<?php
session_start();
require_once 'BD.php';

$email = $_POST['email'];
$password = $_POST['password'];

$conn = BD::getInstancia();

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->execute([':email' => $email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($password, $usuario['password'])) {

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['rol'] = $usuario['rol'];
    $_SESSION['nombre'] = $usuario['nombre'];

    header("Location: ../../views/dashboard.php");
    exit;

} else {
    header("Location: ../../views/login.php?error=1");
    exit;
}