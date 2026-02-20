<?php
    require_once("../Modelo/Correctivo.php");
    $obj = new correctivo();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idCorr'] = isset($post['idCorr']) ? limpiarCadena($post['idCorr']):"";
        $post['idDep'] = isset($post['idDep']) ? limpiarCadena($post['idDep']):"";
        $post['id_area'] = isset($post['id_area']) ? limpiarCadena($post['id_area']):"";
        $post['idPer'] = isset($post['idPer']) ? limpiarCadena($post['idPer']):"";
        $post['fechaR'] = isset($post['fechaR']) ? limpiarCadena($post['fechaR']):"";
        $post['descrip'] = isset($post['descrip']) ? limpiarCadena($post['descrip']):"";
        
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