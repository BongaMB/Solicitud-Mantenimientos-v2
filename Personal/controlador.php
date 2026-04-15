<?php
    require_once("../Modelo/Personal.php");
    $obj = new personal();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idPer'] = isset($post['idPer']) ? limpiarCadena($post['idPer']):"";
        $post['nombrePer'] = isset($post['nombrePer']) ? limpiarCadena($post['nombrePer']):"";
        $post['correo'] = isset($post['correo']) ? limpiarCadena($post['correo']):"";
        $post['cargo'] = isset($post['cargo']) ? limpiarCadena($post['cargo']):"";
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