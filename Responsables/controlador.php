<?php
    require_once("../Modelo/Responsable.php");
    $obj = new responsable();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idRes'] = isset($post['idRes']) ? limpiarCadena($post['idRes']):"";
        $post['nombreRes'] = isset($post['nombreRes']) ? limpiarCadena($post['nombreRes']):"";
        $post['correo'] = isset($post['correo']) ? limpiarCadena($post['correo']):"";
        $post['tel'] = isset($post['tel']) ? limpiarCadena($post['tel']):"";
        $post['encar'] = isset($post['encar']) ? limpiarCadena($post['encar']):"";
        $post['PR'] = isset($post['PR']) ? limpiarCadena($post['PR']):"";
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