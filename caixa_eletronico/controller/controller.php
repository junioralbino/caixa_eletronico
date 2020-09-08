<?php

session_start();
include_once'../model/conexao.php';
include_once'../model/contas.php';


$contas = new Contas();

$tipo = addslashes($_POST['agencia']);
$valor = addslashes($_POST['conta']);
$senha = md5($_POST['senha']);

if(isset($_POST['conta']) && !empty($_POST['conta'])){
    $contas->setLogget($agencia,$conta,$senha);

}




?>