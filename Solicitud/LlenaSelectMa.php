<?php
      require_once("../Modelo/Mantenimiento.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new mantenimientos();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idTM = $tupla['id_Man'];  
          $tipo = $tupla['mantenimiento'];
          echo "<option value='$idTM'>$tipo</option>";
      }
?>