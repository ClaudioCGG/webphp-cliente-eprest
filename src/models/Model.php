<?php

namespace models;

use controllers\Connection;

abstract class Model {
    public abstract function save(Connection $connection);

    public static function escapeData($input) {
        if (!is_null($input)) {
            $input = trim($input);
            $input = htmlspecialchars($input);
            return stripslashes($input);
        }
        return ''; // O un valor predeterminado apropiado para tu caso
    }
}