<?php

require_once 'Usuario.php';

class Administrador extends Usuario {

    public function __construct(int $id, string $nombre, string $email, string $password, string $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }


    //metodo que no se cuando se usa
    public function gestionarUsuarios() {
        return "El administrador puede gestionar usuarios";
    }
}