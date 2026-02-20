<?php
      require_once("../Modelo/Areas.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Areas();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idarea = $tupla['id_area'];  
          $nomarea = $tupla['nombre_area'];
          echo "<option value='$idarea'>$nomarea</option>";
      }
?>