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

    public function agregarUsuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $fecha_nacimiento, $telefono, $correo, $direccion) {
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
    public function actualizarUsuario($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $fecha_nacimiento, $telefono, $correo, $direccion)
    {
        // Lógica para actualizar un usuario
        $query = "UPDATE usuarios SET primer_nombre = :primer_nombre, segundo_nombre = :segundo_nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, edad = :edad, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, correo = :correo, direccion = :direccion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':primer_nombre', $primer_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':segundo_nombre', $segundo_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido', $primer_apellido, PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $segundo_apellido, PDO::PARAM_STR);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
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
        // Lógica para eliminar un usuario
    }
}
