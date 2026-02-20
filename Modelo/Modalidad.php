<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class modalidad
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $tipo = $post['tipo'];
            $sentencia = "Insert into Modalidad (tipo) values 
            ('$tipo')";
            $post['idModalidad'] = EjecutaConsecutivo($sentencia);
            return $post['idModalidad'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idMod = $post['idModalidad'];
            $tipo = $post['tipo'];
            $sentencia = "Update Modalidad set tipo='$tipo' Where idModalidad='$idMod'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idMod = $post['idModalidad'];
            $sentencia = "Delete From Modalidad Where idModalidad=$idMod";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select idModalidad, tipo from Modalidad order by tipo";
              return Consulta($query);
          }

              
        
    }

    ?>