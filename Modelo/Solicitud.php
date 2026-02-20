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
            $idres = $post['idRes'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $encar = $post['encar'];
            $em = $post['EM'];
            $obcer = $post['obser'];
           $sentencia = "INSERT INTO solicitud (idModalidad, idDep, id_Man, idRes, fechadeRealizacion, Descripcion, Encargado, Evalucion, obcervaciones)
            VALUES ( '$idMod', '$iddep', '$tiposer', '$idres', '$fechaR', '$descri', '$encar', '$em', '$obcer')"; // encar esta en el lugar de firma por que es el nombre y firma del encargado

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
            $idres = $post['idRes'];
            $fechaR = $post['fechaR'];
            $descri = $post['descrip'];
            $encar = $post['encar'];
            $em = $post['EM'];
            $obcer = $post['obser'];
            $sentencia = "Update solicitud set idModalidad='$idMod' , idDep='$iddep' , id_Man='$tiposer', idRes='$idres', fechadeRealizacion='$fechaR', Descripcion='$descri', Encargado='$encar', Evalucion='$em', obcervaciones='$obcer' Where idSoli='$idsoli'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idsoli = $post['idSoli'];
            $sentencia = "Delete From solicitud Where idSoli=$idsoli";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "SELECT s.idSoli, m.idModalidad, m.tipo , d.idDep, d.nombreDep, x.id_Man, x.mantenimiento , r.idRes, r.nombreRes, s.fechadeRealizacion, s.Descripcion, d.Encargado, s.Evalucion, s.obcervaciones FROM  solicitud s  INNER JOIN modalidad m ON m.idModalidad = s.idModalidad INNER JOIN departamento d ON d.idDep = s.idDep INNER JOIN responsable r ON r.idRes = s.idRes inner join mantenimiento x on x.id_Man=s.id_Man;";
              return Consulta($query);
          }
 
    }

    ?>