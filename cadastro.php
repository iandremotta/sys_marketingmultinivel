<?php
session_start();
require 'config.php';
if (empty($_SESSION['mmnlogin'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST['email']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $id_pai = $_SESSION['mmnlogin'];
    $senha = md5($email);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();
    if ($sql->rowCount() == 0) {
        $sql = $pdo->prepare("INSERT INTO usuarios (id_pai, nome, email, senha) VALUES (:id_pai, :nome, :email, :senha)");
        $sql->bindValue(":id_pai", $id_pai);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        header("Location: index.php");
        exit;
    } else {
        echo "Usuário já cadastrado.";
    }
}
?>

<h2>Cadastrar novo usuário</h2>
<form method="POST">
    Nome: <br>
    <input type="text" name="nome" id="nome"> <br>
    Email: <br>
    <input type="email" name="email" id="email">
    <br>
    <input type="submit" value="Cadastrar">
</form>