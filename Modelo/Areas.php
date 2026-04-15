<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class Areas
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $nomarea = $post['nomArea'];
            $dire = $post['dire'];
            $subdir = $post['subdir'];
            $direfi = $post['direfi'];
            $oficina = $post['oficina'];
           
            $sentencia = "Insert into Areas (nombre_area, director , subdirector , direccion_fisica , oficina) values 
            ('$nomarea' , '$dire'  , '$subdir' , '$direfi' , '$oficina')";
            $post['id_area'] = EjecutaConsecutivo($sentencia);
            return $post['id_area'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idarea = $post['id_area'];
            $nomarea = $post['nomArea'];
            $dire = $post['dire'];
            $subdir = $post['subdir'];
            $direfi = $post['direfi'];
            $oficina = $post['oficina'];
            $sentencia = "Update Areas set nombre_area='$nomarea' , director='$dire' , subdirector='$subdir' , direccion_fisica='$direfi' , oficina='$oficina' Where id_area='$idarea'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idarea = $post['id_area'];
            $sentencia = "Delete From Areas Where id_area=$idarea";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select id_area , nombre_area  , director , subdirector , direccion_fisica , oficina from Areas";
              return Consulta($query);
          }

              
        
    }

    ?>