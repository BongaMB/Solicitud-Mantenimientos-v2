<?php
      require_once("../Modelo/Modalidad.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new modalidad();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idMod = $tupla['idModalidad'];  
          $tipo = $tupla['tipo'];
          echo "<option value='$idMod'>$tipo</option>";
      }
?>