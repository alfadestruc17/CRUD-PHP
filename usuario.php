<?php

require_once 'database.php';

class Usuario
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function listarUsuarios()
    {
        // Lógica para obtener todos los usuarios
        $query = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function obtenerUsuario($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ?: null;
    }


    public function agregarUsuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $telefono, $correo, $direccion)
    {
        try {
            $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono, correo, direccion)
                    VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :telefono, :correo, :direccion)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':primer_nombre' => $primer_nombre,
                ':segundo_nombre' => $segundo_nombre,
                ':primer_apellido' => $primer_apellido,
                ':segundo_apellido' => $segundo_apellido,
                ':fecha_nacimiento' => $fecha_nacimiento,
                ':telefono' => $telefono,
                ':correo' => $correo,
                ':direccion' => $direccion
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage() . "\n";
            return false;
        }
    }
    public function actualizarUsuario($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $telefono, $correo, $direccion)
    {
        // Lógica para actualizar un usuario
        $query = "UPDATE usuarios SET primer_nombre = :primer_nombre, segundo_nombre = :segundo_nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, correo = :correo, direccion = :direccion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':primer_nombre', $primer_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':segundo_nombre', $segundo_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido', $primer_apellido, PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $segundo_apellido, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarUsuario($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                echo "Usuario con ID $id no existe.\n";
                return false;
            }

            echo "¿Estás seguro que deseas eliminar al usuario: {$usuario['primer_nombre']} {$usuario['primer_apellido']}? (si/no): ";
            $confirmacion = strtolower(trim(readline()));
            if ($confirmacion !== 'si') {
                echo "Operación cancelada.\n";
                return false;
            }
            $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
            echo "Usuario eliminado correctamente.\n";
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar: " . $e->getMessage() . "\n";
            return false;
        }
    }
    public function validarTelefono($telefono)
    {
        return !empty(trim($telefono));
    }

    public function validarCorreo($correo)
    {
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }
    public function validarNombre($nombre)
    {
        return !empty(trim($nombre));
    }
    public function validarFecha($fecha)
    {
        $fecha_regex = "/^\d{4}-\d{2}-\d{2}$/";
        return preg_match($fecha_regex, $fecha);
    }
    public function getEdad($fecha_nacimiento)
    {
        $fecha_nacimiento = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento)->y;
        return $edad;
    }
}
