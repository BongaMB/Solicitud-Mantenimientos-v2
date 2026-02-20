<?php
    require_once("../Modelo/Areas.php");
    $obj = new Areas();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['id_area'] = isset($post['id_area']) ? limpiarCadena($post['id_area']):"";
        $post['nomArea'] = isset($post['nomArea']) ? limpiarCadena($post['nomArea']):"";
        $post['idDep'] = isset($post['idDep']) ? limpiarCadena($post['idDep']):"";
        $post['dire'] = isset($post['dire']) ? limpiarCadena($post['dire']):"";
        $post['subdir'] = isset($post['subdir']) ? limpiarCadena($post['subdir']):"";
        $post['direfi'] = isset($post['direfi']) ? limpiarCadena($post['direfi']):"";
        $post['oficina'] = isset($post['oficina']) ? limpiarCadena($post['oficina']):"";

    

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