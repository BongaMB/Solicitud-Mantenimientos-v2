<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class tiposEquipos
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $nomtip = $post['nomTip'];
            $sentencia = "Insert into tipos (nombre_tipo) values 
            ('$nomtip')";
            $post['idTip'] = EjecutaConsecutivo($sentencia);
            return $post['idTip'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idtip = $post['idTip'];
            $nomtip = $post['nomTip'];
            $sentencia = "Update tipos set nombre_tipo='$nomtip' Where id_tipo='$idtip'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idtip = $post['idTip'];
            $sentencia = "Delete From tipos Where id_tipo=$idtip";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select id_tipo, nombre_tipo from tipos order by nombre_tipo";
              return Consulta($query);
          }

              
        
    }

    ?>