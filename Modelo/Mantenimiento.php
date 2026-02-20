<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class mantenimientos
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $man = $post['Man'];
            $sentencia = "Insert into mantenimiento (mantenimiento) values ('$man')";
            $post['id_Man'] = EjecutaConsecutivo($sentencia);
            return $post['id_Man'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idman = $post['id_Man'];
            $tipo = $post['Man'];
            $sentencia = "Update mantenimiento set mantenimiento='$tipo' Where id_Man='$idman'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idMod = $post['id_Man'];
            $sentencia = "Delete From mantenimiento Where id_Man=$idMod";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select id_Man, mantenimiento from mantenimiento order by mantenimiento";
              return Consulta($query);
          }

              
        
    }

    ?>