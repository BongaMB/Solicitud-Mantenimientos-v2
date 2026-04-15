<?php
      require_once("../Modelo/Personal.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new personal(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idper = $tupla['idPer'];  
          $nomper = $tupla['nombrePer'];
          $correo = $tupla['correoPer'];
          $cargo = $tupla['cargoPer'];
          // aqui inician los parametros del departamento
          $iddep = $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];

          echo "<tr id='$idper'><td>$nomper</td><td>$correo</td><td>$cargo</td><td>$nomdep</td>
          <td>
            <i class='material-icons edit' data-idPer='$idper' data-nombrePer='$nomper' data-correo='$correo' data-cargo='$cargo' data-idDep='$iddep' data-nomdep='$nomdep'>create</i>
            <i class='material-icons delete' data-idPer='$idper'>delete_forever</i>
            </td></tr>";
      }
?>
