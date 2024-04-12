<?php
$servidor = "roundhouse.proxy.rlwy.net";
$usuario = "root";
$senha = "NuNYdwJIweHfZfUYbJKmuIMDFJimPwDt";
$bancoDados = "railway";
$porta = "26201";

try{
    $conn = mysqli_connect($servidor,$usuario,$senha,$bancoDados, $porta);
}catch(mysqli_sql_exception $e){
    echo "". $e->getMessage();
}
