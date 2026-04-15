<?php
    require_once("../Modelo/Jefes.php");
    $obj = new Jefes();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idjefe'] = isset($post['idjefe']) ? limpiarCadena($post['idjefe']):"";
        $post['nom'] = isset($post['nom']) ? limpiarCadena($post['nom']):"";
        $post['correo'] = isset($post['correo']) ? limpiarCadena($post['correo']):"";
        $post['tel'] = isset($post['tel']) ? limpiarCadena($post['tel']):"";
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