<?php
      require_once("../Modelo/Modalidad.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new modalidad(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idMod = $tupla['idModalidad'];  
          $tipo = $tupla['tipo'];
          echo "<tr id=$idMod><td>$tipo</td>
          <td>
            <i class='material-icons edit' data-idModalidad='$idMod' data-tipo='$tipo'>create</i>
            <i class='material-icons delete' data-idModalidad='$idMod'>delete_forever</i>
            </td></tr>";
      }
?>
