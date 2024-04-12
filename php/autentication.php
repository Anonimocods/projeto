<?php
session_start(); 

include_once("conexao.php");

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

$comando = "select * from usuario where usu_email = '$email' ";

$result = mysqli_query($conn, $comando);

if(mysqli_num_rows($result) != 0) {
    $usuario = $result->fetch_assoc();
    if($usuario['usu_email'] == $email && password_verify($senha, $usuario['usu_senha'])){

        $_SESSION['loggin'] = $usuario['usu_id'];
       header("Location: ../vitrine.html");
   exit;
    }else{
        $_SESSION['msg'] = "Desculpe, Dados Incompativeis, Tente Novamente."; 
    }
}else{
echo "<script> alert('Desculpe, Dados Incompativeis, Tente Novamente.'); window.location.href = '../index.html'; </script>";
//header("Location: ../index.html");
}
    
