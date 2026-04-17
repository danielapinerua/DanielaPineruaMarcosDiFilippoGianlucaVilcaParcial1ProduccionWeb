<?php
require_once 'Usuario.php';

class Administrador extends Usuario {

    public function __construct($id, $nombre, $email, $password, $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }

    public function gestionarUsuarios() {
        return "El administrador puede gestionar usuarios";
    }
}