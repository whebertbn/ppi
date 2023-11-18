<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "database.php";
    require_once "entidade.php";
    
  $conn = new Conexao();

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifica se o e-mail já está cadastrado
    $sql_verificar = "SELECT email FROM ALUNO WHERE email = ?";
    $stmt_verificar = $conn->conexao->prepare($sql_verificar);
    $stmt_verificar->bindParam(1, $email);
    $stmt_verificar->execute();

    if ($stmt_verificar->rowCount() > 0) {
        echo "E-mail já cadastrado. Escolha outro e-mail.";
    } else {
        // Insere o novo usuário no banco de dados
        $sql_cadastrar = "INSERT INTO ALUNO (email, senha) VALUES (?, ?)";
        $stmt_cadastrar = $conn->conexao->prepare($sql_cadastrar);

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt_cadastrar->bindParam(1, $email);
        $stmt_cadastrar->bindParam(2, $senha_hash);

        if ($stmt_cadastrar->execute()) {
            // Evita saída antes do redirecionamento
            header('Location: /privada/login/credenciaisAluno.html');
            exit();
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
}
?>
