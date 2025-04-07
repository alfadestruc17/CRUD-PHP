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
        // Lógica para obtener un usuario por ID
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        //se optiene el usuario por id
    }

    public function agregarUsuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $fecha_nacimiento, $telefono, $correo, $direccion)
    {
        try {
            $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, telefono, correo, direccion)
                    VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :edad, :fecha_nacimiento, :telefono, :correo, :direccion)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':primer_nombre' => $primer_nombre,
                ':segundo_nombre' => $segundo_nombre,
                ':primer_apellido' => $primer_apellido,
                ':segundo_apellido' => $segundo_apellido,
                ':edad' => $edad,
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
    public function actualizarUsuario()
    {
        // Lógica para actualizar un usuario
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
}
