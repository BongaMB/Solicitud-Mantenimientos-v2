<?php
      require_once("../Modelo/Equipos.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new equipo (); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idequi = $tupla['id_equipo'];
          $nom = $tupla['nombre'];

          $idtip = $tupla['id_tipo'];
          $nomtip = $tupla['nombre_tipo'];

          $marca = $tupla['marca'];
          $modelo= $tupla['modelo'];
          $serial = $tupla['seriale'];

          $idubi = $tupla['id_ubicacion'];
          $nomubi = $tupla['nombre_ubicacion'];

          $fechaad = $tupla['fecha_adquisicion'];
          $estado = $tupla['estado'];
          
      
          echo "<tr id=$idequi>
          <td>$nom</td>
          <td>$nomtip</td>
          <td>$marca</td>
          <td>$modelo</td>
          <td>$serial</td>
          <td>$nomubi</td>
          <td>$estado</td>
          <td>$fechaad</td>
          <td>
            <i class='material-icons edit' data-idEq='$idequi' data-nom='$nom' data-idTip='$idtip' data-nomTip='$nomtip' data-marca='$marca' data-modelo='$modelo' data-serial='$serial' data-id_ubicacion='$idubi' data-nomUbi='$nomubi' data-estado='$estado' data-fechaad='$fechaad' >create</i>
            <i class='material-icons delete' data-idEq='$idequi'>delete_forever</i>
            </td></tr>";
      }
?>
