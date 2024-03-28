<?php
include("conecion_base_db.php");
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    if(!empty($email) && !empty($contraseña))
    {
        $query = "SELECT * FROM usuarios WHERE email = '$email' AND contraseña = '$contraseña' LIMIT 1";
        $resultado = mysqli_query($conex,$query);
        ob_start();

        $row=$resultado->fetch_array();
        $_SESSION['usuario']=$row['email'];
        if($resultado)
        {
            if($resultado && mysqli_num_rows($resultado) > 0)
            {
                $consulta="SELECT *FROM usuarios where email like'$email'";
                $resultado=mysqli_query($conex,$consulta);
                if($resultado){
                    while ($row=$resultado->fetch_array()) {
                    $tipo=$row['tipo'];
                    $_SESSION['credencial']=$row['credencial'];
                    echo $tipo;
                    }
                    if($tipo=="alumno"){
                        header("Location: usuario.php");
                        die;
                    }else if($tipo=="docente"){
                        header("Location: usuario.php");
                        die;
                    }else if($tipo=="administrativo"){
                        header("Location: administradorespag.php");
                        die;
                    }
                }
            }
            else
            {
                echo "ERROR: usuario o contraseña incorrecta";
            }
        }

    }
    else
    {
        echo "ERROR: porfavor escriba su email y contrasenna";
    }
}