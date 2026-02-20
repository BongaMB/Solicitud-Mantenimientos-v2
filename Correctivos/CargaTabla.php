<?php
      require_once("../Modelo/Correctivo.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new correctivo (); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idCorr = $tupla['idCorr'];


          $iddep = $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];

          $idarea= $tupla['id_area'];
          $nomarea = $tupla['nombre_area'];
      
          $idper = $tupla['idPer'];
          $nomper = $tupla['nombrePer'];

          $fechaela = $tupla['fecha_elabo'];
          $descrip = $tupla['Descripcion'];
      
          echo "<tr id='$idCorr'>
          <td>$nomdep</td>
          <td>$nomarea</td>
          <td>$nomper</td>
          <td>$fechaela</td>
          <td>$descrip</td>
          <td>
            <i class='material-icons edit' data-idCorr='$idCorr' data-idDep='$iddep' data-nomdep='$nomdep' data-id_area='$idarea' data-nomarea='$nomarea' data-idPer='$idper' data-nomper='$nomper' data-fechaR='$fechaela' data-descrip='$descrip' >create</i>
            <i class='material-icons delete' data-idCorr='$idCorr'>delete_forever</i>
            </td></tr>";
      }
?>
