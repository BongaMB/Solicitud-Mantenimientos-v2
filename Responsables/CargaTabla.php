<?php
      require_once("../Modelo/Responsable.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new responsable(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idres = $tupla['idRes'];  
          $nomres = $tupla['nombreRes'];
          $correo = $tupla['correoRes'];
          $tel= $tupla['telefonoRes'];
          $encar = $tupla['Encargado'];
          $PR = $tupla['puestoRes'];
          // aqui inician los parametros del departamento
          $iddep = $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];
          echo "<tr id=$idres><td>$nomres</td><td>$correo</td><td>$tel</td><td>$encar</td><td>$PR</td><td>$nomdep</td>
          <td>
            <i class='material-icons edit' data-idRes='$idres' data-nombreRes='$nomres' data-correo='$correo' data-tel='$tel' data-encar='$encar' data-PR='$PR' data-idDep='$iddep' data-nomdep='$nomdep'>create</i>
            <i class='material-icons delete' data-idRes='$idres'>delete_forever</i>
            </td></tr>";
      }
?>
