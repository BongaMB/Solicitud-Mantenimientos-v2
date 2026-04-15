<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class solicitud
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $idMod = $post['idModalidad'];
            $iddep = $post['idDep'];
            $tiposer = $post['id_Man'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $em = $post['em'];
            $obcer = $post['obser'];

            $sentencia = "INSERT INTO solicitud 
                (idModalidad, idDep, id_Man, idPer, fechadeRealizacion, Descripcion, Evalucion, obcervaciones)
                VALUES ('$idMod', '$iddep', '$tiposer', '$idper', '$fechaR', '$descri', '$em', '$obcer')";

            $post['idSoli'] = EjecutaConsecutivo($sentencia);
            return $post['idSoli'];
        }

        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idsoli = $post['idSoli'];

            $idMod = $post['idModalidad'];
            $iddep = $post['idDep'];
            $tiposer = $post['id_Man'];
            $idper = $post['idPer'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $em = $post['em'];
            $obcer = $post['obser'];

            $sentencia = "UPDATE solicitud 
                SET idModalidad='$idMod', idDep='$iddep', id_Man='$tiposer', idPer='$idper', 
                    fechadeRealizacion='$fechaR', Descripcion='$descri', Evalucion='$em', obcervaciones='$obcer' 
                WHERE idSoli='$idsoli'";
            return Ejecuta($sentencia);
        }

        public function Eliminar($post)
        {
            $idsoli = $post['idSoli'];
            $sentencia = "DELETE FROM solicitud WHERE idSoli=$idsoli";
            return Ejecuta($sentencia);
        }

        public function Consultar()
        {
            $query = "SELECT 
                        s.idSoli, 
                        m.idModalidad, m.tipo, 
                        d.idDep, d.nombreDep, 
                        x.id_Man, x.mantenimiento, 
                        p.idPer, p.nombrePer, 
                        s.fechadeRealizacion, 
                        s.Descripcion,
                        j.idjefe, j.nom, 
                        s.Evalucion, 
                        s.obcervaciones
                      FROM solicitud s
                      INNER JOIN modalidad m ON m.idModalidad = s.idModalidad
                      INNER JOIN departamento d ON d.idDep = s.idDep
                      INNER JOIN jefes j ON d.idjefe = j.idjefe
                      INNER JOIN personal p ON s.idPer = p.idPer
                      INNER JOIN mantenimiento x ON x.id_Man = s.id_Man;";
            return Consulta($query);
        }
    }
?>
