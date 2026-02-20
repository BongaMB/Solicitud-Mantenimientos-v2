<?php
      require_once("../Modelo/ubicacion.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new ubicacion();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idubi = $tupla['id_ubicacion'];  
          $nomubi = $tupla['nombre_ubicacion'];
          echo "<option value='$idubi'>$nomubi</option>";
      }
?>