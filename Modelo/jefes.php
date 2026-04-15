<?php
    require "../Utilerias/conexion.php"; // Importamos la conexión a la base de datos
    class jefes
    {
        public function __construct()
        {

        }
    
        public function Insertar(&$post)
        {
            $nom = $post['nom'];
            $correo = $post['correo'];
            $tel = $post['tel'];
            $sentencia = "Insert into jefes (nom , correo , tel) values ('$nom' , '$correo' , '$tel')";
            $post['idjefe'] = EjecutaConsecutivo($sentencia);
            return $post['idjefe'];
        }
        //Metodo para Actualizar
        public function Actualizar($post)
        {
            $idjefe = $post['idjefe'];
            $nom = $post['nom'];
            $correo = $post['correo'];
            $tel = $post['tel'];
            $sentencia = "Update jefes set nom='$nom' , correo='$correo' , tel='$tel' Where idjefe='$idjefe'";
            return Ejecuta($sentencia);
        }
        public function Eliminar($post)
        {
            $idjefe = $post['idjefe'];
            $sentencia = "Delete From jefes Where idjefe=$idjefe";
            return Ejecuta($sentencia);
        }

          public function Consultar()
          {
              $query = "select idjefe, nom , correo , tel from jefes order by nom";
              return Consulta($query);
          }

              
        
    }

    ?>