<?php
      require_once("../Modelo/Personal.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new personal();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $iddep = $tupla['idPer'];  
          $nomdep = $tupla['nombrePer'];
          echo "<option value='$iddep'>$nomdep</option>";
      }
?>