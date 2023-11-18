<?php

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "post") {
    $usuario = addslashes($_POST['usuario']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    
    $verifica_usuario = "SELECT * FROM USUARIOS WHERE USUARIO = '$usuario'";
    $consulta_usuario = mysqli_query($conexao, $verifica_usuario);

    if(mysqli_num_rows($consulta_usuario) > 0){
        header('location: cadastro.php?erro=usuario_existente');
        exit();
    }

    $inserir_usuario = "INSERT INTO USUARIOS (USUARIO, SENHA) VALUES ('$usuario', '$senha')";
    $resultado = mysqli_query($conexao, $inserir_usuario);

    if($resultado){
        header('location: login.php');
        exit();
    } else {
        header('location: cadastro.php?erro=registro_falhou');
        exit();
    }

} else {

    header('location: cadastro.php');
    exit();
}
?>
