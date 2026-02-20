<?php
      require_once("../Modelo/Areas.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new Areas(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idarea = $tupla['id_area'];  
          $nomarea = $tupla['nombre_area'];
          $iddep = $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];
          $dire = $tupla['director'];
          $sub = $tupla['subdirector'];
          $dirf = $tupla['direccion_fisica'];
          $oficina = $tupla['oficina'];
          
          
          // aqui inician los parametros del departamento
          echo "<tr id=$idarea><td>$nomarea</td><td>$nomdep</td><td>$dire</td><td>$sub</td><td>$dirf</td><td>$oficina</td>
          <td>
            <i class='material-icons edit' data-id_area='$idarea' data-nomArea='$nomarea' data-idDep='$iddep' data-nombreDep='$nomdep' data-dire='$dire' data-subdir='$sub' data-direfi='$dirf' data-oficina='$oficina'>create</i>
            <i class='material-icons delete' data-id_area='$idarea'>delete_forever</i>
            </td></tr>";
      }
?>
