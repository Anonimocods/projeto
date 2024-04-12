<?php
include_once("conexao.php");

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
$number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
$gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

if ($password !== $confirmPassword) {
    echo "<script> alert('Eu sei o que você está tentando fazer.'); window.location.href = 'cad_usuario.html'; </script>";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO cliente (cli_nome, cli_sobre_nome, cli_email, cli_senha, cli_telefone, cli_cpf, cli_cnpj, cli_genero) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword', '$number', '$cpf', '$cnpj', '$gender')";
try {
    mysqli_query($conn, $query);
    header("Location: index.html");
    exit;
} catch (mysqli_sql_exception $e) {
    echo "" . $e->getMessage() . "";
    header("Location: cadastro_de_clientes.html");
}

