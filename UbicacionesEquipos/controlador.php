<?php
    require_once("../Modelo/ubicacion.php");
    $obj = new ubicacion();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['id_ubicacion'] = isset($post['id_ubicacion']) ? limpiarCadena($post['id_ubicacion']):"";
        $post['nom_ubi'] = isset($post['nom_ubi']) ? limpiarCadena($post['nom_ubi']):"";
        $post['descri'] = isset($post['descri']) ? limpiarCadena($post['descri']):"";
        $post['idDep'] = isset($post['idDep']) ? limpiarCadena($post['idDep']):"";
    

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