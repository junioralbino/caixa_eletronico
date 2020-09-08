<?php 


session_start();
include_once'../model/conexao.php';
include_once'../model/contas.php';


$contas = new Contas();

$tipo = addslashes($_POST['tipo']);
$valor = str_replace(",",".",$_POST['valor']);
$valor = floatval($valor);

if(isset($_POST['valor'])){
    $contas->settransacao($tipo,$valor);

}

header("location: ../index.php?transacao_sucesso");



?>