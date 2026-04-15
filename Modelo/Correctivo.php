<?php
    require "../Utilerias/conexion.php"; 
    class correctivo
    {
        public function __construct() { }
    
        public function Insertar(&$post)
        {
            $iddep = $post['idDep'];
            $idarea = $post['id_area'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            // Se recomienda insertar con un estado inicial por defecto
            $sentencia = "INSERT INTO correctivo (idDep, id_area, idPer, fecha_elabo, Descripcion, nuevos_estado)
                          VALUES ('$iddep', '$idarea', '$idper', '$fechaR', '$descri', 'Pendiente')";
            $post['idCorr'] = EjecutaConsecutivo($sentencia);
            return $post['idCorr'];
        }

        public function Actualizar($post)
        {
            $idCorr = $post['idCorr'];
            $iddep = $post['idDep'];
            $idarea = $post['id_area'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $sentencia = "UPDATE correctivo SET idDep='$iddep', id_area='$idarea', idPer='$idper', fecha_elabo='$fechaR', Descripcion='$descri' WHERE idCorr='$idCorr'";
            return Ejecuta($sentencia);
        }

        //Actualizacion para el estado
        public function ActualizarEstado($id, $estado) {
            $sql = "UPDATE correctivo SET nuevos_estado = '$estado' WHERE idCorr = $id";
            return Ejecuta($sql); 
        }

        public function Eliminar($post)
        {
            $idcorr = $post['idCorr'];
            $sentencia = "DELETE FROM correctivo WHERE idCorr=$idcorr";
            return Ejecuta($sentencia);
        }

        public function Consultar()
        {
            // Se agregó c.nuevos_estado a la consulta
            $query = "SELECT c.idCorr, d.idDep, d.nombreDep, a.id_area, a.nombre_area, 
                             p.idPer, p.nombrePer, c.fecha_elabo, c.Descripcion, c.nuevos_estado
                      FROM correctivo c
                      INNER JOIN departamento d ON c.idDep=d.idDep
                      INNER JOIN areas a ON c.id_area=a.id_area
                      INNER JOIN personal p ON c.idPer = p.idPer";
            
            return Consulta($query);
        }
    }
?>