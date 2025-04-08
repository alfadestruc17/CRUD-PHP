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
            $pn = trim(readline());
            if (!$usuario->validarNombre($pn)) {
                echo "❌ El primer nombre no puede estar vacío.\n";
                break;
            }
            if (!$usuario->validarNombreCompleto($pn)) {
                echo "❗ El primer nombre solo puede contener letras.\n";
                break;
            }
            echo "Segundo nombre (opcional): ";
            $sn = readline();
            if ($sn && !$usuario->validarNombreCompleto($sn)) {
                echo "❗ El segundo nombre solo puede contener letras.\n";
                break;
            }
            echo "Primer apellido: ";
            $pa = trim(readline());
            if (!$usuario->validarNombre($pa)) {
                echo "❌ El primer apellido no puede estar vacío.\n";
                break;
            }
            if (!$usuario->validarNombreCompleto($pa)) {
                echo "❗ El primer apellido solo puede contener letras.\n";
                break;
            }
            echo "Segundo apellido (opcional): ";
            $sa = readline();
            if ($sa && !$usuario->validarNombreCompleto($sa)) {
                echo "❗ El segundo apellido solo puede contener letras.\n";
                break;
            }
            echo "Fecha nacimiento (YYYY-MM-DD): ";
            $fn = trim(readline());
            if (!$usuario->validarFecha($fn)) {
                echo "❗ Fecha inválida. Formato esperado: YYYY-MM-DD.\n";
                break;
            }

            echo "Teléfono: ";
            $tel = trim(readline());
            if (!$usuario->validarTelefono($tel)) {
                echo "❗ Teléfono inválido.\n";
                break;
            }
            if (!preg_match("/^\d{10}$/", $tel)) {
                echo "❗ El teléfono debe contener 10 dígitos y no pueden ser letras.\n";
                break;
            }
            echo "Correo: ";
            $correo = trim(readline());
            if (!$usuario->validarCorreo($correo)) {
                echo "❗ Correo inválido.\n";
                break;
            }
            echo "Dirección: ";
            $dir = readline();

            $resultado = $usuario->agregarUsuario($pn, $sn, $pa, $sa, $fn, $tel, $correo, $dir);
            echo $resultado ? "✅ Usuario agregado correctamente en la base de datos.\n" : "❌ No se pudo agregar el usuario en la base de datos.\n";
            break;

        case "2":
            echo "Lista de usuarios:\n";
            $usuarios = $usuario->listarUsuarios();
            foreach ($usuarios as $user) {
                echo "ID: {$user['id']}, Nombre completo: {$user['primer_nombre']} {$user['segundo_nombre']} {$user['primer_apellido']} {$user['segundo_apellido']}, Fecha de nacimiento: {$user['fecha_nacimiento']}, Teléfono: {$user['telefono']}\n";
            }
            break;
        case "3":
            echo "Ingrese el ID del usuario a obtener: ";
            $id = (int)readline();
            $usuarioData = $usuario->obtenerUsuario($id);
            if ($usuarioData) {
                echo "Usuario encontrado:\n";
                echo "ID: {$usuarioData['id']}, Nombre completo: {$usuarioData['primer_nombre']} {$usuarioData['segundo_nombre']} {$usuarioData['primer_apellido']} {$usuarioData['segundo_apellido']}, Fecha de nacimiento: {$usuarioData['fecha_nacimiento']}, Teléfono: {$usuarioData['telefono']}\n";
            } else {
                echo "❗ Usuario no encontrado.\n";
            }

            break;
        case "4":
            echo "Seleccione el ID del usuario a actualizar: ";
            $id = (int)readline();
            $usuarioData = $usuario->obtenerUsuario($id);
            if ($usuarioData) {
                echo "Usuario encontrado\n";
                echo "Ingrese los nuevos datos (dejar en blanco para no cambiar):\n";
                echo "Primer nombre: ";
                $pn = readline();
                echo "Segundo nombre (opcional): ";
                $sn = readline();
                echo "Primer apellido: ";
                $pa = readline();
                echo "Segundo apellido (opcional): ";
                $sa = readline();
                echo "Fecha nacimiento (YYYY-MM-DD): ";
                $fn = readline();
                if ($fn && !$usuario->validarFecha($fn)) {
                    echo "❗ Fecha inválida. Formato esperado: YYYY-MM-DD.\n";
                    break;
                }
                echo "Teléfono: ";
                $tel = readline();
                echo "Correo: ";
                $correo = readline();
                if ($correo && !$usuario->validarCorreo($correo)) {
                    echo "❗ Correo inválido.\n";
                    break;
                }
                echo "Dirección: ";
                $dir = readline();


                $usuario->actualizarUsuario($id, $pn, $sn, $pa, $sa, $fn, $tel, $correo, $dir);
                echo "✅ Usuario actualizado correctamente en la base de datos.\n";
            } else {
                echo "❗ Usuario no encontrado.\n";
            }



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
