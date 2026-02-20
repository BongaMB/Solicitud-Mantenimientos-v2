<?php
      require_once("../Modelo/TipoMantenimiento.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new mantenimiento();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idTM = $tupla['idTM'];  
          $tipo = $tupla['tipo'];
          echo "<option value='$idTM'>$tipo</option>";
      }
?>