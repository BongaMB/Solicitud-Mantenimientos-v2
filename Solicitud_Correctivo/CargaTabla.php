<?php
      require_once("../Modelo/Correctivo.php"); 
      $obj = new correctivo(); 
      $tuplas = $obj->Consultar(); 

      foreach ($tuplas as $tupla){
          $idCorr = $tupla['idCorr'];
          $nomdep = $tupla['nombreDep'];
          $nomarea = $tupla['nombre_area'];
          $nomper = $tupla['nombrePer'];
          $fechaela = $tupla['fecha_elabo'];
          $descrip = $tupla['Descripcion'];

          // 1. Obtener el estado (Asegúrate que 'nuevos_estado' es el nombre real en tu BD)
          $estado = !empty($tupla['nuevos_estado']) ? $tupla['nuevos_estado'] : 'Pendiente';

          // 2. Definir el color con !important para que DataTables no lo sobrescriba
          $estiloFila = "";
          if ($estado == 'Aceptado') {
              $estiloFila = "background-color: #C8E6C9 !important;"; 
          } elseif ($estado == 'Rechazado') {
              $estiloFila = "background-color: #FFCDD2!important; "; 
          } else {
              $estiloFila = "background-color: #FFE0B2 !important;"; // Naranja para Pendiente
          }
      
          // 3. SE AGREGA EL STYLE AL TR
          echo "<tr id='$idCorr' style='$estiloFila'> 
          <td>$nomdep</td>
          <td>$nomarea</td>
          <td>$nomper</td>
          <td>$fechaela</td>
          <td>$descrip</td>
          <td>
            <i class='material-icons edit' data-idCorr='$idCorr' data-idDep='".$tupla['idDep']."' data-nomdep='$nomdep' data-id_area='".$tupla['id_area']."' data-nomarea='$nomarea' data-idPer='".$tupla['idPer']."' data-nomper='$nomper' data-fechaR='$fechaela' data-descrip='$descrip' >create</i>
            <i class='material-icons delete' data-idCorr='$idCorr'>delete_forever</i>
            <i class='material-icons btn-aceptar green-text' style='cursor:pointer' data-idCorr='$idCorr'>check_circle</i>
            <i class='material-icons btn-rechazar red-text' style='cursor:pointer' data-idCorr='$idCorr'>cancel</i>
          </td></tr>";
      }
?>