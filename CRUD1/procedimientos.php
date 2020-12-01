<?php
    $conexion=new mysqli("localhost","root","","evn404vue");
    if($conexion-> connect_error){
        die("falló la conexión".$conexion->connect_error);
    } 
    $resultado=array('error'=>false);
    $accion=''; 

    if (isset($_GET['accion'])){
        $accion= $_GET['accion']; 
    }

    if($accion=="leer"){
        $sql=$conexion->query("SELECT * FROM usuarios");
        $usuarios= array();
        while($row=$sql->fetch_assoc()){
            array_push($usuarios, $row);
        }
        $resultado['usuarios']=$usuarios;
    }

    if($accion=="insertar"){
        $contrasena= $_POST["Contrasenia"];
        $correo = $_POST["Correo"];
        $perfil= $_POST["Perfil"];
        $a="INSERT INTO usuarios(Correo, Contrasenia, Perfil) VALUES ('$correo', '$contrasena', '$perfil')";
   echo $a;
        $sql=$conexion->query($a);
      
        if($sql){
            $resultado['mensaje']="Usuario Registrado"; 
        }
        else{
            $resultado['error']=true;
            $resultado['mensaje']="Usuario no  registrado";
        }
    }

    if($accion=="editar"){
        $id = $_POST['id'];
        $contrasena= $_POST["Contrasenia"];
        $correo = $_POST["Correo"];
        $perfil= $_POST["Perfil"];
        $a=("UPDATE usuarios SET Correo='$correo', Contrasenia='$contrasena', Perfil='$perfil' WHERE id='$id'");
   echo $a;
        $sql=$conexion->query($a);
      
        if($sql){
            $resultado['mensaje']="Usuario actualizado"; 
        }
        else{
            $resultado['error']=true;
            $resultado['mensaje']="Usuario no actualizado";
        }
    }

    if($accion=="eliminar"){
        $id = $_POST['id'];
        $a=("DELETE FROM usuarios WHERE id='$id'");
   echo $a;
        $sql=$conexion->query($a);
      
        if($sql){
            $resultado['mensaje']="Usuario eliminado"; 
        }
        else{
            $resultado['error']=true;
            $resultado['mensaje']="Usuario no eliminado";
        }
    }

    
    $conexion->close();
    echo json_encode($resultado);
?>