<?php
    require_once("../Modelo/Equipos.php");
    $obj = new equipo();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idEq'] = isset($post['idEq']) ? limpiarCadena($post['idEq']):"";
        $post['nom'] = isset($post['nom']) ? limpiarCadena($post['nom']):"";
        $post['idTip'] = isset($post['idTip']) ? limpiarCadena($post['idTip']):"";
        $post['marca'] = isset($post['marca']) ? limpiarCadena($post['marca']):"";
        $post['modelo'] = isset($post['modelo']) ? limpiarCadena($post['modelo']):"";
        $post['serial'] = isset($post['serial']) ? limpiarCadena($post['serial']):"";
        $post['id_ubicacion'] = isset($post['id_ubicacion']) ? limpiarCadena($post['id_ubicacion']):"";
        $post['estado'] = isset($post['estado']) ? limpiarCadena($post['estado']):"";
        $post['fechaad'] = isset($post['fechaad']) ? limpiarCadena($post['fechaad']):"";
        
        

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