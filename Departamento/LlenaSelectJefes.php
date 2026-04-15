<?php
      require_once("../Modelo/Jefes.php");// Importa el Modelo de la clase clasf para mandar ejecutar el método de Consulta
      $obj = new Jefes();
      $tuplas = $obj->Consultar();
      foreach ($tuplas as $tupla){
          $idjefe = $tupla['idjefe'];  
          $nom = $tupla['nom'];
          echo "<option value='$idjefe'>$nom</option>";
      }
?>