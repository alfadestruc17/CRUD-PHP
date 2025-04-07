<?php

require_once 'Usuario.php';

function menu()
{
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
            echo $resultado ? "✅ Usuario agregado correctamente en la base de datos.\n" : "❌ No se pudo agregar el usuario en la base de datos.\n";
            break;

        case "2":
            echo "Lista de usuarios:\n";
            $usuarios = $usuario->listarUsuarios();
            foreach ($usuarios as $user) {
                echo "ID: {$user['id']}, Nombre completo: {$user['primer_nombre']} {$user['segundo_nombre']} {$user['primer_apellido']} {$user['segundo_apellido']}, Edad: {$user['edad']}, Teléfono: {$user['telefono']}\n";
            }
            break;
        case "3":
            echo "obtener usuario.\n";
            break;
        case "4":
            echo "actualizar usuario.\n";
            break;
        case "5":
            echo ("lista de usuarios: ") . "\n";
            $usuarios = $usuario->listarUsuarios();
            foreach ($usuarios as $user) {
                echo "ID: {$user['id']}, Nombre completo: {$user['primer_nombre']} {$user['segundo_nombre']} {$user['primer_apellido']} {$user['segundo_apellido']}\n";
            }
            echo "Ingrese el ID del usuario a eliminar: ";
            $id = readline();
            if (!is_numeric($id)) {
                echo "ID inválido. Debe ser un número.\n";
                break;
            }
            $usuario->eliminarUsuario((int)$id);
            break;
        case "6":
            echo "Saliendo...\n";
            exit;
        default:
            echo "❗ Opción no válida.\n";
    }
}
// Aquí puedes probar:
