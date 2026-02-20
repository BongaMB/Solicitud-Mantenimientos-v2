<?php
      require_once("../Modelo/tiposEquipos.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new tiposequipos();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idtip = $tupla['id_tipo'];  
          $nomtip = $tupla['nombre_tipo'];
          echo "<option value='$idtip'>$nomtip</option>";
      }
?>