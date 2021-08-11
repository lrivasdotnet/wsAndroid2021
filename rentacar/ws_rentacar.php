<?php
    require("config.php");
    $arreglo = array();
    $accion = "";
    //accion = 1 -> Registrar, 2-> Extraer Datos, 3->Modificar, 4-Eliminar

    //Verbo => POST, GET, DELETE, UPDATE
    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
    }

    if($accion==1){
        //Registrar
        $m = $_POST["m"];
        $a = $_POST["a"];
        $estatus = agregarCarro($m,$a);
        $arreglo["accion"] = $accion;
        if($estatus=="true"){
            $arreglo["resultado"] = "Datos registrados con exito";
        }else{
            $arreglo["resultado"] = "Error al intentar registrar los datos";
        }
        
    }else if($accion==2){
        //Extraer Datos
        $arreglo["accion"] = $accion;
        $arreglo["resultado"] = buscarCarro();
    }else if($accion==3){
        //Modificar Datos
        $arreglo["accion"] = $accion;
        
        $m = $_POST["m"];
        $a = $_POST["a"];
        $i = $_POST["i"];
        $estatus = editarCarro($i,$m,$a);
        $arreglo["accion"] = $accion;
        if($estatus=="true"){
            $arreglo["resultado"] = "Datos modificados con exito";
        }else{
            $arreglo["resultado"] = "Error al intentar modificar los datos";
        }
    }else if($accion==4){
        //Eliminar Datos
        $arreglo["accion"] = $accion;
              
        $i = $_POST["i"];
        $estatus = eliminarCarro($i);
        $arreglo["accion"] = $accion;
        if($estatus=="true"){
            $arreglo["resultado"] = "Datos eliminados con exito";
        }else{
            $arreglo["resultado"] = "Error al intentar eliminar los datos";
        }
    }
    
   

    echo json_encode($arreglo);
?>