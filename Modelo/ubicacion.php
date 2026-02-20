<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class ubicacion
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $nomubi = $post['nom_ubi'];
            $descri = $post['descri'];
            $iddep = $post['idDep'];
           
            $sentencia = "Insert into ubicaciones (nombre_ubicacion, descripcion , idDep) values 
            ('$nomubi', '$descri' , '$iddep')";
            $post['id_ubicacion'] = EjecutaConsecutivo($sentencia);
            return $post['id_ubicacion'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idubi = $post['id_ubicacion'];
            $nomubi = $post['nom_ubi'];
            $descri = $post['descri'];
            $iddep = $post['idDep'];
            $sentencia = "Update ubicaciones set nombre_ubicacion='$nomubi', descripcion='$descri' , idDep='$iddep' Where id_ubicacion='$idubi'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idubi = $post['id_ubicacion'];
            $sentencia = "Delete From ubicaciones Where id_ubicacion=$idubi";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select u.id_ubicacion , u.nombre_ubicacion , u.descripcion , d.idDep , d.nombreDep from ubicaciones u inner join departamento d on u.idDep = d.idDep ";
              return Consulta($query);
          }

              
        
    }

    ?>