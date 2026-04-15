<?php
    require_once "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class departamento
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $nomdep = $post['nombreDep'];
            $correo = $post['correoDep'];
            $tel = $post['telefono'];
            $idjefe = $post['idjefe'];
            $idarea = $post['id_area'];
            $sentencia = "Insert into departamento (nombreDep, correoDep , telefono , idjefe, id_area ) values 
            ('$nomdep', '$correo' , '$tel' , '$idjefe' , '$idarea')";
            $post['idDep'] = EjecutaConsecutivo($sentencia);
            return $post['idDep'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $iddep = $post['idDep'];
            $nomdep = $post['nombreDep'];
            $correo = $post['correoDep'];
            $tel = $post['telefono'];
            $idjefe = $post['idjefe'];
            $idarea = $post['id_area'];
            $sentencia = "Update departamento set nombreDep='$nomdep', correoDep='$correo' , telefono='$tel' , idjefe='$idjefe' , id_area='$idarea' Where idDep='$iddep'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $iddep = $post['idDep'];
            $sentencia = "Delete From departamento Where idDep=$iddep";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select d.idDep , d.nombreDep, d.correoDep, d.telefono, j.idjefe , j.nom , a.id_area , a.nombre_area from departamento d inner join areas a on d.id_area=a.id_area inner join jefes j on d.idjefe=j.idjefe";
              return Consulta($query);
          }

              
        
    }

    ?>