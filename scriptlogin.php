<?php
//Start na sessão
session_start();

//Conectando com o banco de dados
include("conexao.php");
$conn=conectar();

//Verificar se os campos estão vazios
if(empty($_POST["email"]) || empty($_POST["senha"])){
    header("Location: login.php");//Redirecionando o usuário
    exit();
}

//Recuperando os dados do formulário
$email = $_POST['email'];
$senha = MD5($_POST['senha']);

//Criando uma query para verificar se os dados do usuário são válidos
$query = $conn->prepare("SELECT id FROM usuarios WHERE email = :e and senha = :s");

//Validando os dados no banco de dados
$query->bindValue(":e", $email);
$query->bindValue(":s", $senha);

//Executando a consulta com o método execute
$query->execute();

$row=$query->rowCount();//Função para contar linhas

//echo $row;

//Criar um condição para verificar o retorno da consulta
//Se for VERDADEIRO redirecionar o usuário para uma sessão no sistema.
//Se for FALSO redirecionar o usuário para a página de login.
if($row == 1){
    $_SESSION['usuario'] = $email;
    header("Location: painel.php");
    exit();
}
else{
    $_SESSION['nao_autenticado']=true;
    header("location: login.php");
    exit();
}


?>