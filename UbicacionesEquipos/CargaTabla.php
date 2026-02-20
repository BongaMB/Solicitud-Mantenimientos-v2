<?php
      require_once("../Modelo/ubicacion.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new ubicacion(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idubi = $tupla['id_ubicacion'];  
          $nomubi = $tupla['nombre_ubicacion'];
          $descri = $tupla['descripcion'];
          $iddep = $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];
          
          
          // aqui inician los parametros del departamento
          echo "<tr id=$idubi><td>$nomubi</td><td>$descri</td><td>$nomdep</td>
          <td>
            <i class='material-icons edit' data-id_ubicacion='$idubi' data-nom_ubi='$nomubi' data-descri='$descri' data-idDep='$iddep' data-nombreDep='$nomdep'>create</i>
            <i class='material-icons delete' data-id_ubicacion='$idubi'>delete_forever</i>
            </td></tr>";
      }
?>
