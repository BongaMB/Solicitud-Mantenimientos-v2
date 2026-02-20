<?php
      require_once("../Modelo/Mantenimiento.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new mantenimientos(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idMod = $tupla['id_Man'];  
          $tipo = $tupla['mantenimiento'];
          echo "<tr id=$idMod><td>$tipo</td>
          <td>
            <i class='material-icons edit' data-id_Man='$idMod' data-Man='$tipo'>create</i>
            <i class='material-icons delete' data-id_Man='$idMod'>delete_forever</i>
            </td></tr>";
      }
?>
