<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
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
            $encar = $post['Encargado'];
            $sentencia = "Insert into departamento (nombreDep, correoDep , telefono , Encargado ) values 
            ('$nomdep', '$correo' , '$tel' , '$encar')";
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
            $encar = $post['Encargado'];
            $sentencia = "Update departamento set nombreDep='$nomdep', correoDep='$correo' , telefono='$tel' , Encargado='$encar' Where idDep='$iddep'";
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
              $query = "select idDep, nombreDep , correoDep , telefono , Encargado from departamento order by nombreDep";
              return Consulta($query);
          }

              
        
    }

    ?>