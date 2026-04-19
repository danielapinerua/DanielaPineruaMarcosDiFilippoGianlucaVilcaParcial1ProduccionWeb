<?php

require_once 'Usuario.php';

class Empleado extends Usuario {

    public function __construct(int $id, string $nombre, string $email, string $password, string $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }
}