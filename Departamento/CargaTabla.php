<?php
      require_once("../Modelo/departamento.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new departamento(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $iddep = $tupla['idDep'];  
          $nomdep = $tupla['nombreDep'];
          $correo = $tupla['correoDep'];
          $tel = $tupla['telefono'];
          $encar = $tupla['Encargado'];
          echo "<tr id=$iddep><td>$nomdep</td><td>$correo</td><td>$tel</td><td>$encar</td>
          <td>
            <i class='material-icons edit' data-idDep='$iddep' data-nombreDep='$nomdep' data-correoDep='$correo' data-telefono='$tel' data-Encargado='$encar'>create</i>
            <i class='material-icons delete' data-idDep='$iddep'>delete_forever</i>
            </td></tr>";
      }
?>
