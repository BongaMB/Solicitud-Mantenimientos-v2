<?php
      require_once("../Modelo/Jefes.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new Jefes(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idjefe = $tupla['idjefe'];  
          $nom = $tupla['nom'];
          $correo = $tupla['correo'];
          $tel = $tupla['tel'];
          echo "<tr id=$idjefe><td>$nom</td><td>$correo</td><td>$tel</td>
          <td>
            <i class='material-icons edit' data-idjefe='$idjefe' data-nom='$nom' data-correo='$correo' data-tel='$tel'>create</i>
            <i class='material-icons delete' data-idjefe='$idjefe'>delete_forever</i>
            </td></tr>";
      }
?>
