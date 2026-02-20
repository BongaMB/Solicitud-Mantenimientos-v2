<?php
      require_once("../Modelo/Solicitud.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta
      $obj = new solicitud (); //instancia
      $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar

      foreach ($tuplas as $tupla){
          $idsoli = $tupla['idSoli'];


          $idmod = $tupla['idModalidad'];
          $tipom = $tupla['tipo'];

          $iddep= $tupla['idDep'];
          $nomdep = $tupla['nombreDep'];
          $encar = $tupla['Encargado'];

          $idman = $tupla['id_Man'];
          $mante = $tupla['mantenimiento'];

          $idres = $tupla['idRes'];
          $nomres = $tupla['nombreRes'];

          $fechar = $tupla['fechadeRealizacion'];
          $descrip = $tupla['Descripcion'];
          $em = $tupla['Evalucion'];
          $obser = $tupla['obcervaciones'];
      
          echo "<tr id=$idsoli>
          <td>$tipom</td>
          <td>$nomdep</td>
          <td>$mante</td>
          <td>$nomres</td>
          <td>$fechar</td>
          <td>$descrip</td>
          <td>$encar</td>
          <td>$em</td>
          <td>$obser</td>
          <td>
            <i class='material-icons edit' data-idSoli='$idsoli' data-idModalidad='$idmod' data-tipom='$tipom' data-idDep='$iddep' data-nombreDep='$nomdep' data-id_Man='$idman' data-nomman='$mante' data-idRes='$idres' data-nombreRes='$nomres' data-fechaR='$fechar' data-descrip='$descrip' data-encar='$encar' data-EM='$em' data-obser='$obser'>create</i>
            <i class='material-icons delete' data-idSoli='$idsoli'>delete_forever</i>
            </td></tr>";
      }
?>
