<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class personal
    {
        public function __construct()
        {

        }
    
    public function Insertar(&$post)
{
    $nomper = $post['nombrePer'];
    $correo = $post['correo'];
    $cargo = $post['cargo'];
    $iddep = $post['idDep'];
    $idarea = $post['id_area'];
    $sentencia = "Insert into personal (nombrePer,  correoPer, cargoPer, idDep , id_area ) values 
    ('$nomper',  '$correo', '$cargo', $iddep , $idarea)";
    $post['idPer'] = EjecutaConsecutivo($sentencia);
    return $post['idPer'];
}

        //Metodo para Actualizar
  public function Actualizar($post)
{
    $idper = $post['idPer'];
    $nomper = $post['nombrePer'];
    $correo = $post['correo']; 
    $cargo = $post['cargo'];
    $iddep = $post['idDep'];
    $idarea = $post['id_area'];

    $sentencia = "UPDATE personal SET nombrePer='$nomper', correoPer='$correo', cargoPer='$cargo', idDep='$iddep', id_area='$idarea' WHERE idPer='$idper'";
    return Ejecuta($sentencia);
}

        public function Eliminar($post)
        {
            $idper = $post['idPer'];
            $sentencia = "Delete From personal Where idPer=$idper";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select p.idPer , p.nombrePer, p.correoPer, p.cargoPer, d.idDep, d.nombreDep , a.id_area , a.nombre_area from personal p inner join departamento d on p.idDep=d.idDep inner join Areas a on p.id_area=a.id_area";
              return Consulta($query);
          }

              
        
    }

    ?>