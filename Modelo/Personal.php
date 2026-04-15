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
    $sentencia = "Insert into personal (nombrePer,  correoPer, cargoPer, idDep) values 
    ('$nomper',  '$correo', '$cargo', $iddep)";
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
    

    $sentencia = "UPDATE personal SET nombrePer='$nomper', correoPer='$correo', cargoPer='$cargo', idDep='$iddep' WHERE idPer='$idper'";
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
              $query = "select p.idPer , p.nombrePer, p.correoPer, p.cargoPer, d.idDep, d.nombreDep from personal p inner join departamento d on p.idDep=d.idDep";
              return Consulta($query);
          }

              
        
    }

    ?>