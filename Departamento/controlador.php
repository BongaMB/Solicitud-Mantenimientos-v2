<?php
    require_once("../Modelo/departamento.php");
    $obj = new departamento();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idDep'] = isset($post['idDep']) ? limpiarCadena($post['idDep']):"";
        $post['nombreDep'] = isset($post['nombreDep']) ? limpiarCadena($post['nombreDep']):"";
        $post['correoDep'] = isset($post['correoDep']) ? limpiarCadena($post['correoDep']):"";
        $post['telefono'] = isset($post['telefono']) ? limpiarCadena($post['telefono']):"";
        $post['idjefe'] = isset($post['idjefe']) ? limpiarCadena($post['idjefe']):"";
        $post['id_area'] = isset($post['id_area']) ? limpiarCadena($post['id_area']):"";

        $accion = $post["accion"];
        if ($accion == "Ins") $result = $obj->Insertar($post);
        if ($accion == "Act") $result = $obj->Actualizar($post);
        if ($accion == "Eli") $result = $obj->Eliminar($post);
        if ($result){
            $response['status']=1; 
            $response['data']=$post; 
        }
        else{
                $response['status']=0; 
                $response['data']=$post;
        }
    }
    else{
        $response['status']=0; 
        $response['data']=$post; 
   }
   echo json_encode($response);     
?>