<?php
session_start();
require 'config.php';

if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        $_SESSION['mmnlogin'] = $sql['id'];
        header("location: index.php");
        exit;
    } else {
        echo "Usuário e/ou senha não encontrados. <br>";
        echo $email . "<br>";
        echo $senha;
    }
}
?>
<h2>Tela de login</h2>
<form action="" method="post">
    Email: <br>
    <input type="email" name="email" id="email"><br>
    Senha: <br>
    <input type="password" name="senha" id="senha"><br>
    <input type="submit" value="Enviar">
</form>