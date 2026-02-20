<?php
    require_once("../Modelo/TipoMantenimiento.php");
    $obj = new mantenimiento();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idTM'] = isset($post['idTM']) ? limpiarCadena($post['idTM']):"";
        $post['tipo'] = isset($post['tipo']) ? limpiarCadena($post['tipo']):"";

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