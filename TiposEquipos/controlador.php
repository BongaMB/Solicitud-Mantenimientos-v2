<?php
    require_once("../Modelo/tiposEquipos.php");
    $obj = new tiposEquipos();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idTip'] = isset($post['idTip']) ? limpiarCadena($post['idTip']):"";
        $post['nomTip'] = isset($post['nomTip']) ? limpiarCadena($post['nomTip']):"";
        
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