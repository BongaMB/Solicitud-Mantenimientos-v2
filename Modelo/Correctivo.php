<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class correctivo
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {

            $iddep = $post['idDep'];
            $idarea = $post['id_area'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
           $sentencia = "INSERT INTO correctivo ( idDep, id_area, idPer, fecha_elabo, Descripcion)
            VALUES ( '$iddep', '$idarea', '$idper', '$fechaR', '$descri')"; // encar esta en el lugar de firma por que es el nombre y firma del encargado
            $post['idCorr'] = EjecutaConsecutivo($sentencia);
            return $post['idCorr'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
             $idCorr = $post['idCorr'];
            $iddep = $post['idDep'];
            $idarea = $post['id_area'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $sentencia = "Update correctivo set idDep='$iddep' , id_area='$idarea', idPer='$idper', fecha_elabo='$fechaR', Descripcion='$descri' Where idCorr='$idCorr'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idcorr = $post['idCorr'];
            $sentencia = "Delete From correctivo Where idCorr=$idcorr";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "SELECT c.idCorr , d.idDep , d.nombreDep , a.id_area , a.nombre_area , p.idPer , p.nombrePer , c.fecha_elabo , c.Descripcion
                FROM correctivo c
                INNER JOIN departamento d ON c.idDep=d.idDep
                INNER JOIN areas a ON c.id_area=a.id_area
                INNER JOIN personal p ON c.idPer = p.idPer;
                ";
              return Consulta($query);
          }
 
    }

    ?>