<?php
    function conectar(){
        //Conectarme
        //Credenciales
            //Direccion IP / Nombre Dominio del Servidor
        $servidor = "localhost";
        $usuario = "root";
        $password = "root";
        $bd = "rentacar";

        //Establece la conexion al servidor
        $idConexion = mysqli_connect($servidor,$usuario,$password,$bd);
        if(!$idConexion){
            $idConexion = mysqli_error($idConexion);
        }
        return $idConexion;
    }

    function desconectarme($idConexion){
        mysqli_close($idConexion);
    }

    function agregarCarro($marca,$anio){
        //Conectarte
        $idConexion = conectar();
        //Prepara un comando
        $comando = "INSERT INTO vehiculos (marca,anio) VALUES ('$marca','$anio')";
        //Ejecutalo
        if(mysqli_query($idConexion,$comando)){
            $estatus = "true";
        }else{
            $estatus = "false";
        }
        //Devolve un resultado
        return $estatus;
        //Cerra la conexión
        desconectarme($idConexion);
    }

    function eliminarCarro($id_vehiculo){
        //Conectarte
        $idConexion = conectar();
        //Prepara un comando
        $comando = "DELETE FROM vehiculos 
         WHERE id_vehiculo='$id_vehiculo'";
        //Ejecutalo
        if(mysqli_query($idConexion,$comando)){
            $estatus = "true";
        }else{
            $estatus = "false";
        }
        //Devolve un resultado
        return $estatus;
        //Cerra la conexión
        desconectarme($idConexion);
    }

    function editarCarro($id_vehiculo,$marca,$anio){
        //Conectarte
        $idConexion = conectar();
        //Prepara un comando
        $comando = "UPDATE vehiculos SET marca='$marca',anio='$anio'
         WHERE id_vehiculo='$id_vehiculo'";
        //Ejecutalo
        if(mysqli_query($idConexion,$comando)){
            $estatus = "true";
        }else{
            $estatus = "false";
        }
        //Devolve un resultado
        return $estatus;
        //Cerra la conexión
        desconectarme($idConexion);
    }

    function buscarCarro(){
        //Conectarte
        $idConexion = conectar();
        //Arreglo
        $datosFila = array();
        //Prepara un comando
        $comando = "SELECT * from vehiculos";
        $query = mysqli_query($idConexion,$comando);
        //Devolver el numero de filas de la consulta
        $filas = mysqli_num_rows($query);
        if($filas!=0){
            //Recorrer cada registro
            while($cadaFila = mysqli_fetch_array($query)){
                $nuevaFila = array();
                $id_vehiculo = $cadaFila["id_vehiculo"];
                $marca = $cadaFila["marca"];
                $anio = $cadaFila["anio"];

                $nuevaFila["id"] = $id_vehiculo;
                $nuevaFila["marca"] = $marca;
                $nuevaFila["anio"] = $anio;

                $datosFila[] = $nuevaFila;
            }
        }
       
        //Cerra la conexión
        desconectarme($idConexion);
        return array_values($datosFila);
    }
?>