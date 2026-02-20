<?php
      require_once("../Modelo/departamento.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new departamento();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $iddep = $tupla['idDep'];  
          $nomdep = $tupla['nombreDep'];
          echo "<option value='$iddep'>$nomdep</option>";
      }
?>