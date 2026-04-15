<?php
      require_once("../Modelo/Personal.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Personal();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idper = $tupla['idPer'];  
          $nomper = $tupla['nombrePer'];
          echo "<option value='$idper'>$nomper</option>";
      }
?>