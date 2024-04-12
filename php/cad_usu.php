<?php
include_once("conexao.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_STRING);
$cargo = "1";

$busca1 = "select * from usuario where usu_email = '$email' ";
$resultado1 = mysqli_query($conn, $busca1);

$busca2 = "select * from usuario where usu_empresa = '$empresa' ";
$resultado2 = mysqli_query($conn, $busca2);

if(mysqli_num_rows($resultado1) != 0) {
    echo "<script> alert('Email já cadastrado, tente outro.'); window.location.href = '../cad_usuario.html'; </script>";
    exit;
}

if(mysqli_num_rows($resultado2) != 0) {
    echo "<script> alert('Empresa já cadastrada, tente outra.'); window.location.href = '../cad_usuario.html'; </script>";
    exit;
}


$hashedsenha = password_hash($senha, PASSWORD_DEFAULT);

$query = "INSERT INTO usuario (usu_nome, usu_email, usu_senha, usu_empresa, usu_cargo) VALUES ('$nome', '$email', '$hashedsenha',  '$empresa', '$cargo')";
try {
    mysqli_query($conn, $query);
    header("Location: ../index.html");
    exit;
} catch (mysqli_sql_exception $e) {
    echo "" . $e->getMessage() . "";
}

