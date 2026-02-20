<?php
    require_once("../Modelo/Mantenimiento.php");
    $obj = new mantenimientos();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['id_Man'] = isset($post['id_Man']) ? limpiarCadena($post['id_Man']):"";
        $post['Man'] = isset($post['Man']) ? limpiarCadena($post['Man']):"";

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