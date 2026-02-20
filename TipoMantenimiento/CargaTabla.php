<?php
      require_once("../Modelo/TipoMantenimiento.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new mantenimiento(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idMod = $tupla['idTM'];  
          $tipo = $tupla['tipo'];
          echo "<tr id=$idMod><td>$tipo</td>
          <td>
            <i class='material-icons edit' data-idTM='$idMod' data-tipo='$tipo'>create</i>
            <i class='material-icons delete' data-idTM='$idMod'>delete_forever</i>
            </td></tr>";
      }
?>
