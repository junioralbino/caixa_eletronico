<?php

session_start();
include_once'../model/conexao.php';
include_once'../model/contas.php';


$contas = new Contas();
$contas->logout();

header("Location: ../login.php?session_ending_sucess");


?>