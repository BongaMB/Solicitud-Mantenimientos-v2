<?php
      require_once("../Modelo/Responsable.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new responsable();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idres = $tupla['idRes'];  
          $nomres = $tupla['nombreRes'];
          echo "<option value='$idres'>$nomres</option>";
      }
?>