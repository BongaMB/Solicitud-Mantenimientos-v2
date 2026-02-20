<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class Equipo
    {
        public function __construct()
        {

        }
    
    public function Insertar(&$post)
{
    $nom = $post['nom'];
    $idtip = $post['idTip'];
    $marca = $post['marca'];
    $modelo = $post['modelo'];
    $serial = $post['serial'];
    $idubi = $post['id_ubicacion'];
    $fechaad = $post['fechaad'];
    $estado = $post['estado'];
    $sentencia = "Insert into equipos (nombre, id_tipo , marca , modelo, seriale , id_ubicacion , estado, fecha_adquisicion ) values 
    ('$nom', '$idtip' , '$marca' , '$modelo' , '$serial', '$idubi'  , '$estado' , '$fechaad')";
    $post['idEq'] = EjecutaConsecutivo($sentencia);
    return $post['idEq'];
}

        //Metodo para Actualizar
  public function Actualizar($post)
{
    $idequi = $post['idEq'];
     $nom = $post['nom'];
    $idtip = $post['idTip'];
    $marca = $post['marca'];
    $modelo = $post['modelo'];
    $serial = $post['serial'];
    $idubi = $post['id_ubicacion'];
    $fechaad = $post['fechaad'];
    $estado = $post['estado'];

    $sentencia = "UPDATE equipos SET nombre='$nom' , id_tipo='$idtip', marca='$marca', modelo='$modelo', seriale ='$serial', id_ubicacion='$idubi' , estado='$estado' , fecha_adquisicion='$fechaad' WHERE id_equipo='$idequi'";
    return Ejecuta($sentencia);
}

        public function Eliminar($post)
        {
            $idequi = $post['idEq'];
            $sentencia = "Delete From equipos Where id_equipo=$idequi";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "SELECT 
                    e.id_equipo,
                    e.nombre,
                    e.marca,
                    e.modelo,
                    e.seriale,
                    e.estado,
                    e.fecha_adquisicion,
                    t.id_tipo,
                    t.nombre_tipo,
                    u.id_ubicacion,
                    u.nombre_ubicacion
                    FROM equipos e
                    INNER JOIN tipos t ON e.id_tipo = t.id_tipo
                    INNER JOIN ubicaciones u ON e.id_ubicacion = u.id_ubicacion;
                    ";
              return Consulta($query);
          }

              
        
    }

    ?>