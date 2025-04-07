<?php

require_once 'Usuario.php';

function menu() {
    echo "=== Menú ===\n";
    echo "1. crear usuario\n";
    echo "2. listar usuarios\n";
    echo "3. obtener usuario\n";
    echo "4. actualizar usuario\n";
    echo "5. eliminar usuario\n";
    echo "6. salir\n";
    echo "Seleccione una opción: ";
}

$usuario = new Usuario();

while (true) {
    menu();
    $opcion = readline();

    switch ($opcion) {
        case "1":
            echo "Primer nombre: ";
            $pn = readline();
            echo "Segundo nombre (opcional): ";
            $sn = readline();
            echo "Primer apellido: ";
            $pa = readline();
            echo "Segundo apellido (opcional): ";
            $sa = readline();
            echo "Edad: ";
            $edad = (int)readline();
            echo "Fecha nacimiento (YYYY-MM-DD): ";
            $fn = readline();
            echo "Teléfono: ";
            $tel = readline();
            echo "Correo: ";
            $correo = readline();
            echo "Dirección: ";
            $dir = readline();

            $resultado = $usuario->agregarUsuario($pn, $sn, $pa, $sa, $edad, $fn, $tel, $correo, $dir);
            echo $resultado ? "✅ Usuario agregado correctamente.\n" : "❌ No se pudo agregar el usuario.\n";
            break;

        case "2":
            $usuario->listarUsuarios();
            break;

        case "3":
            echo "obtener usuario.\n";
        case "4":
            echo "actualizar usuario.\n";
            break;
        case "5":
            echo "eliminar usuario.\n";
            break;
        case "6":
            echo "Saliendo...\n";
            exit;
        default:
            echo "❗ Opción no válida.\n";
    }
}
// Aquí puedes probar:
