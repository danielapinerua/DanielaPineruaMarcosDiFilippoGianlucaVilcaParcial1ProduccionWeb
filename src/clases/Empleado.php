<?php

require_once 'Usuario.php';

class Empleado extends Usuario {

    public function __construct(int $id, string $nombre, string $email, string $password, string $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }

    public function mostrarPerfil(): string {
        return "Empleado: " . $this->getNombre() . " - Email: " . $this->getEmail() . "<br>Gracias por ser parte de nuestro equipo.";
    }
}