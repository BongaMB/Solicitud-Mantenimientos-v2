<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class mantenimiento
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $tipo = $post['tipo'];
            $sentencia = "Insert into tipomantenimiento (tipo) values 
            ('$tipo')";
            $post['idTM'] = EjecutaConsecutivo($sentencia);
            return $post['idTM'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idMod = $post['idTM'];
            $tipo = $post['tipo'];
            $sentencia = "Update tipomantenimiento set tipo='$tipo' Where idTM='$idMod'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idMod = $post['idTM'];
            $sentencia = "Delete From tipomantenimiento Where idTM=$idMod";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select idTM, tipo from tipomantenimiento order by tipo";
              return Consulta($query);
          }

              
        
    }

    ?>