<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class responsable
    {
        public function __construct()
        {

        }
    
    public function Insertar(&$post)
{
    $nomres = $post['nombreRes'];
    $corr = $post['correo'];
    $tel = $post['tel'];
    $encar = $post['encar'];
    $PR = $post['PR'];
    $iddep = $post['idDep'];
    $sentencia = "Insert into responsable (nombreRes, correoRes , telefonoRes , Encargado, puestoRes, idDep ) values 
    ('$nomres', '$corr' , '$tel' , '$encar' , '$PR', '$iddep')";
    $post['idRes'] = EjecutaConsecutivo($sentencia);
    return $post['idRes'];
}

        //Metodo para Actualizar
  public function Actualizar($post)
{
    $idres = $post['idRes'];
    $nomres = $post['nombreRes'];
    $corr = $post['correo'];
    $tel = $post['tel'];
    $encar = $post['encar'];
    $PR = $post['PR'];
    $iddep = $post['idDep'];

    $sentencia = "UPDATE responsable SET nombreRes='$nomres', correoRes='$corr', telefonoRes='$tel', Encargado='$encar', puestoRes='$PR', idDep='$iddep'WHERE idRes='$idres'";
    return Ejecuta($sentencia);
}

        public function Eliminar($post)
        {
            $idres = $post['idRes'];
            $sentencia = "Delete From responsable Where idRes=$idres";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select p.idRes , p.nombreRes, p.correoRes , p.telefonoRes, p.Encargado, p.puestoRes, d.idDep, d.nombreDep from responsable p inner join departamento d on p.idDep=d.idDep";
              return Consulta($query);
          }

              
        
    }

    ?>