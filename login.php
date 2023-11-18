<?php
    session_start();
    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        require_once "database.php";
        require_once "entidade.php";

        $conn = new Conexao();

        $sql = "SELECT * FROM ALUNO WHERE email = ? and senha = ?";
        $stmt = $conn->conexao->prepare( $sql );

        $stmt->bindParam(1, $_POST["email"]);
        $stmt->bindParam(2, $_POST["senha"]);

        $resultado = $stmt->execute();

        if($stmt->rowCount() == 1) {

            $usuario = new UsuarioEntidade();

            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $usuario->setEmail($rs->email);

            }

            $_SESSION["login"] = "1";
            $_SESSION["usuario"] = $usuario;
            header("Location: index.html");
        }
        else {
            echo "Senha inválida";
        }
    }

?>