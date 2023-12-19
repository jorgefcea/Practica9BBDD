<?php

// Función que sirve para validar y limpiar un campo (Tiene que ser campo de tipo POST)

function validar_campo($campo) {
    $campo = trim($campo);
    $campo = stripcslashes($campo);
    $campo = htmlspecialchars($campo);

    return $campo;
}

?>