<?php
      require_once("../Modelo/departamento.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new departamento(); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $iddep = $tupla['idDep'];  
          $nomdep = $tupla['nombreDep'];
          $correo = $tupla['correoDep'];
          $tel = $tupla['telefono'];
          $idjefe = $tupla['idjefe'];
          $nom = $tupla['nom'];
          $idarea = $tupla['id_area'];
          $nomarea = $tupla['nombre_area'];
          
          echo "<tr id='$iddep'><td>$nomdep</td><td>$correo</td><td>$tel</td><td>$nom</td><td>$nomarea</td>
          <td>
            <i class='material-icons edit' data-idDep='$iddep' data-nombreDep='$nomdep' data-correoDep='$correo' data-telefono='$tel' data-idjefe='$idjefe' data-nom='$nom' data-id_area='$idarea' data-nomarea='$nomarea'>create</i>
            <i class='material-icons delete' data-idDep='$iddep'>delete_forever</i>
            </td></tr>";
      }
?>
