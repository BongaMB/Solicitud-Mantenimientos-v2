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
            $iddep = $post['idDep'];
            $dire = $post['dire'];
            $subdir = $post['subdir'];
            $direfi = $post['direfi'];
            $oficina = $post['oficina'];
           
            $sentencia = "Insert into Areas (nombre_area, idDep , director , subdirector , direccion_fisica , oficina) values 
            ('$nomarea', $iddep , '$dire'  , '$subdir' , '$direfi' , '$oficina')";
            $post['id_area'] = EjecutaConsecutivo($sentencia);
            return $post['id_area'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idarea = $post['id_area'];
            $nomarea = $post['nomArea'];
            $iddep = $post['idDep'];
            $dire = $post['dire'];
            $subdir = $post['subdir'];
            $direfi = $post['direfi'];
            $oficina = $post['oficina'];
            $sentencia = "Update Areas set nombre_area='$nomarea' , idDep='$iddep' , director='$dire' , subdirector='$subdir' , direccion_fisica='$direfi' , oficina='$oficina' Where id_area='$idarea'";
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
              $query = "select a.id_area , a.nombre_area , d.idDep , d.nombreDep , a.director , a.subdirector , a.direccion_fisica , a.oficina from Areas a inner join departamento d on a.idDep = d.idDep ";
              return Consulta($query);
          }

              
        
    }

    ?>