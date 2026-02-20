<?php
    require_once("../Modelo/Solicitud.php");
    $obj = new solicitud();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
      
        $post['idSoli'] = isset($post['idSoli']) ? limpiarCadena($post['idSoli']):"";
        $post['idModalidad'] = isset($post['idModalidad']) ? limpiarCadena($post['idModalidad']):"";
        $post['idDep'] = isset($post['idDep']) ? limpiarCadena($post['idDep']):"";
        $post['id_Man'] = isset($post['id_Man']) ? limpiarCadena($post['id_Man']):"";
        $post['idRes'] = isset($post['idRes']) ? limpiarCadena($post['idRes']):"";
        $post['fechaR'] = isset($post['fechaR']) ? limpiarCadena($post['fechaR']):"";
        $post['descrip'] = isset($post['descrip']) ? limpiarCadena($post['descrip']):"";
        $post['encar'] = isset($post['encar']) ? limpiarCadena($post['encar']):"";
        $post['EM'] = isset($post['EM']) ? limpiarCadena($post['EM']):"";
        $post['obser'] = isset($post['obser']) ? limpiarCadena($post['obser']):"";

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