<?php
      require_once("../Modelo/tiposEquipos.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new tiposEquipos(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idtip = $tupla['id_tipo'];  
          $nomtip = $tupla['nombre_tipo'];
          echo "<tr id=$idtip><td>$nomtip</td>
          <td>
            <i class='material-icons edit' data-idTip='$idtip' data-nomTip='$nomtip'>create</i>
            <i class='material-icons delete' data-idTip='$idtip'>delete_forever</i>
            </td></tr>";
      }
?>
